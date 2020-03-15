<?php


namespace GriffonTech\User\Http\Controllers;


use Carbon\Carbon;
use GriffonTech\Unit\Repositories\UnitRentPaymentRepository;
use GriffonTech\Unit\Repositories\UnitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitRentPaymentsController extends Controller
{

    protected $_config;

    protected $unitRentPaymentRepository;

    protected $unitRepository;

    public function __construct(
        UnitRentPaymentRepository $unitRentPaymentRepository,
        UnitRepository $unitRepository
    )
    {
        $this->_config = request('_config');

        $this->unitRentPaymentRepository = $unitRentPaymentRepository;

        $this->unitRepository = $unitRepository;
    }

    public function create()
    {
        return view($this->_config['view']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'lease_starts' => 'required',
            'lease_ends' => 'required',
            'note' => 'nullable|string'
        ]);
        $postData = $request->except(['_token', '_method']);

        $unit = $this->unitRepository->findOrFail($postData['unit_id']);

        $postData['amount'] = preg_replace('/,+/', '', $postData['amount']);
        $postData['property_id'] = $unit->property_id;

        try {
            DB::beginTransaction();
            $unitRentPayment = $this->unitRentPaymentRepository->create($postData);
            if ($unitRentPayment) {
                if (!$unit->updateLease($unitRentPayment->lease_starts, $unitRentPayment->lease_ends)) {
                    throw new \Exception(sprintf('Could not update the lease duration for unit %s', $unit->identifier));
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            session()->flash('error', 'An error occurred registering the unit rent payment. Please try again later');
            return back();
        }
        if ($postData['generate_receipt']) {
            $this->unitRentPaymentRepository->generateReceipts($unitRentPayment->id);
        }

        session()->flash('success',sprintf('Unit %s rent payment was successfully updated', $unit->identifier));
        return back();
    }

}
