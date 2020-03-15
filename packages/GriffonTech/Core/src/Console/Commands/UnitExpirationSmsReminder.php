<?php


namespace GriffonTech\Core\Console\Commands;

use App\SMSGateWay;
use GriffonTech\Core\Repositories\LeaseExpirationSmsReminderRepository;
use GriffonTech\Tenant\Repositories\TenantRepository;
use GriffonTech\Unit\Repositories\UnitRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UnitExpirationSmsReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:unit_expiration_sms_reminder';

    protected $unitRepository ;

    protected $leaseExpirationSmsReminderRepository;

    protected $tenantRepository;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send SMS to tenants occupying unit to expire within a month';

    /**
     * Create a new command instance.
     * @param $unitRepository
     * @param $leaseExpirationSmsReminderRepository
     * @param $tenantRepository
     * @return void
     */
    public function __construct(
        UnitRepository $unitRepository,
        LeaseExpirationSmsReminderRepository $leaseExpirationSmsReminderRepository,
        TenantRepository $tenantRepository
    )
    {
        parent::__construct();

        $this->unitRepository = $unitRepository;

        $this->leaseExpirationSmsReminderRepository = $leaseExpirationSmsReminderRepository;

        $this->tenantRepository = $tenantRepository;
    }

    public function handle()
    {
        // get all the units about to expire in the next month
        $unitsToExpireInAMonth = $this->unitRepository->getModel()
            ->query()
            ->with([
                'property:id,name'
            ])
            ->where('is_occupied', UnitRepository::OCCUPIED)
            ->whereBetween('lease_ends',
                [DB::raw('CURDATE()'),
                DB::raw('CURDATE() + INTERVAL 30 DAY')
            ])
            ->orderBy('property_id')
            ->get();

        foreach ($unitsToExpireInAMonth as $unitToExpire) {

            // check if the tenants has been notified
            $unitNotified = $this->leaseExpirationSmsReminderRepository
                ->getModel()
                ->where('unit_id', $unitToExpire['id'])
                ->where('lease_ends', $unitToExpire->lease_ends)
                ->first();

                if ($unitNotified) {
                    continue;
                }

                $unitTenants = $this->tenantRepository->findWhere([
                    'unit_id' => $unitToExpire->id,
                    'active' => 1
                ]);

                if (!$unitTenants->isEmpty()) {
                    foreach ($unitTenants as $tenant) {
                        if ($tenant->phone_number) {
                            $message = "This is to inform you that your rent at ".$unitToExpire->property->name ;
                            $message .= " is set to expire on ". $unitToExpire->lease_ends->format('M d, Y'). ". ";
                            $message .= "Please call the management to indicate your interest to retaining or leaving the property.";

                            if ((new SMSGateWay())->sendMessage($tenant->phone_number, $message)
                                ->sendRequestToSMSServer()) {

                                // register the message and store it.
                                $this->leaseExpirationSmsReminderRepository
                                    ->create([
                                        'unit_id' => $unitToExpire->id,
                                        'property_id' => $unitToExpire->property_id,
                                        'tenant_id' => $tenant->id,
                                        'phone_number' => $tenant->phone_number,
                                        'message' => $message,
                                        'lease_ends' => $unitToExpire->lease_ends,
                                    ]);
                            }
                        }
                    }
                }
        }
    }
}
