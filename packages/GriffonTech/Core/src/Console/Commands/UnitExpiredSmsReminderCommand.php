<?php


namespace GriffonTech\Core\Console\Commands;


use App\SMSGateWay;
use GriffonTech\Core\Repositories\LeaseExpirationSmsReminderRepository;
use GriffonTech\Core\Repositories\LeaseExpiredSmsReminderRepository;
use GriffonTech\Tenant\Repositories\TenantRepository;
use GriffonTech\Unit\Repositories\UnitRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UnitExpiredSmsReminderCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:unit_expired_sms_reminder';

    protected $unitRepository ;

    protected $leaseExpiredSmsReminderRepository;

    protected $tenantRepository;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send SMS to tenants occupying units that has expired';

    /**
     * Create a new command instance.
     * @param $unitRepository
     * @param $leaseExpiredSmsReminderRepository
     * @param $tenantRepository
     * @return void
     */
    public function __construct(
        UnitRepository $unitRepository,
        LeaseExpiredSmsReminderRepository $leaseExpiredSmsReminderRepository,
        TenantRepository $tenantRepository
    )
    {
        parent::__construct();

        $this->unitRepository = $unitRepository;

        $this->leaseExpiredSmsReminderRepository = $leaseExpiredSmsReminderRepository;

        $this->tenantRepository = $tenantRepository;
    }


    public function handle()
    {
        // get all the units about to expire in the next month
        $unitsExpired = $this->unitRepository->getModel()
            ->query()
            ->with([
                'property:id,name'
            ])
            ->where('is_occupied', UnitRepository::OCCUPIED)
            ->whereDate('lease_ends', '<', DB::raw('CURDATE()'))
            ->orderBy('property_id')
            ->get();


        foreach ($unitsExpired as $unit) {

            // check if the tenants has been notified
            $unitNotified = $this->leaseExpiredSmsReminderRepository
                ->getModel()
                ->where('unit_id', $unit['id'])
                ->where('lease_ends', $unit->lease_ends)
                ->get();

            if ($unitNotified->count() > 2) {
                continue;
            }

            $unitTenants = $this->tenantRepository->findWhere([
                'unit_id' => $unit->id,
                'active' => 1
            ]);

            if ($unitNotified->count() === 0 ) {

                if (!$unitTenants->isEmpty()) {

                    foreach ($unitTenants as $tenant) {
                        if ($tenant->phone_number) {
                            $message = "This is to inform you that your rent at ".$unit->property->name ;
                            $message .= " expired on ". $unit->lease_ends->format('M d, Y'). ". ";
                            $message .= "Please you are expected to renew this rent within the space of two weeks. Thank you";

                            if ((new SMSGateWay())->sendMessage($tenant->phone_number, $message)
                                ->sendRequestToSMSServer()) {

                                // register the message and store it.
                                $this->leaseExpiredSmsReminderRepository
                                    ->create([
                                        'unit_id' => $unit->id,
                                        'property_id' => $unit->property_id,
                                        'tenant_id' => $tenant->id,
                                        'phone_number' => $tenant->phone_number,
                                        'message' => $message,
                                        'lease_ends' => $unit->lease_ends,
                                    ]);
                                break;
                            }
                        }
                    }
                }


            } else {

                if ( now()->weekOfYear > $unitNotified[0]->created_at->weekOfYear ) {
                    // check if the date is up to 7 days or more
                    // before sending the notification sms.
                    if (!$unitTenants->isEmpty()) {

                        foreach ($unitTenants as $tenant) {
                            if ($tenant->phone_number) {
                                $message = "Final Notice: This is to inform you that your rent at ".$unit->property->name ;
                                $message .= " expired on ". $unit->lease_ends->format('M d, Y'). ". ";
                                $message .= "Please you are expected to renew this rent. Thank you.";

                                if ((new SMSGateWay())->sendMessage($tenant->phone_number, $message)
                                    ->sendRequestToSMSServer()) {

                                    // register the message and store it.
                                    $this->leaseExpiredSmsReminderRepository
                                        ->create([
                                            'unit_id' => $unit->id,
                                            'property_id' => $unit->property_id,
                                            'tenant_id' => $tenant->id,
                                            'phone_number' => $tenant->phone_number,
                                            'message' => $message,
                                            'lease_ends' => $unit->lease_ends,
                                        ]);
                                    break;
                                }
                            }
                        }
                    }

                }
            }
        }
    }

}
