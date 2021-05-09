<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Tenant\Repositories\TenantRepository;
use GriffonTech\Unit\Models\Lease;
use GriffonTech\Unit\Models\LeaseTenant;
use GriffonTech\Unit\Repositories\LeaseRepository;
use GriffonTech\Unit\Repositories\UnitRepository;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class LeasesController extends Controller
{
    protected $_config;

    protected $leaseRepository;
    protected $propertyRepository;
    protected $unitRepository;
    protected $tenantRepository;


    public function __construct(
        LeaseRepository $leaseRepository,
        PropertyRepository $propertyRepository,
        UnitRepository $unitRepository,
        TenantRepository $tenantRepository
    )
    {
        $this->_config = request('_config');
        $this->leaseRepository = $leaseRepository;
        $this->propertyRepository = $propertyRepository;
        $this->unitRepository = $unitRepository;
        $this->tenantRepository = $tenantRepository;
    }


    public function index()
    {
        $leases = $this->leaseRepository
            ->findWhere([
                'signature_status' => 0
            ]);

        return view($this->_config['view'])
            ->with(compact('leases'));
    }


    public function create()
    {
        $properties = ['' => ''] + $this->propertyRepository->findWhere([
            'company_id' => auth()->user()->company_id
        ])->pluck('address', 'id')
            ->toArray();


        return view($this->_config['view'])
            ->with(compact('properties'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'signature_status' => 'required',
            'property_id' => 'required',
            'unit_id' => 'required',
            'lease_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);


        try {
            $lease = $this->leaseRepository->create($request->input());
            if ($lease) {
                //process lease rent
                $lease_rents = $request->input('rent');
                if (!empty($lease_rents)) {
                    foreach ($lease_rents as $rent) {
                        if (empty($rent['amount'])) {
                            continue;
                        }
                        $rentData = $rent;
                        $rentData['memo'] = (!empty($rentData['memo'])) ? $rentData['memo'] : 'Rent';
                        $rentData['start_date'] = $lease->start_date;
                        $rentData['end_date'] = $lease->end_date;
                        $lease->rents()->create($rentData);
                    }
                }
                $lease_charges = $request->input('charges');
                if (!empty($lease_charges)) {
                    foreach ($lease_charges as $charge) {
                        if (empty($charge['amount'])) {
                            continue;
                        }
                        $charge['memo'] = (!empty($charge['memo'])) ? $charge['memo'] : 'Charge';
                        $lease->charges()->create($charge);
                    }
                }
                session()->flash('success', 'Lease draft was successfully created');
            } else {
                session()->flash('error', 'Lease draft could not be created. Please try again.');
                return back();
            }
        } catch (ValidatorException $e) {
            session()->flash('error', 'Lease draft could not be created because of an internal validation error. Please try again.');
        }
        return redirect()
            ->route($this->_config['redirect']);
    }

    public function edit(Lease $lease)
    {
        $properties = ['' => ''] + $this->propertyRepository->findWhere([
                'company_id' => auth()->user()->company_id
            ])->pluck('address', 'id')
                ->toArray();

        $units = $this->unitRepository->findWhere([
            'property_id' => $lease->property_id
        ])->pluck('identifier', 'id');

        return view($this->_config['view'])
            ->with(compact('lease',
                'properties', 'units'));
    }


    public function update(Request $request, Lease $lease)
    {
        $this->validate($request, [
            'signature_status' => 'required',
            'property_id' => 'required',
            'unit_id' => 'required',
            'lease_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        if ($lease->update($request->input())) {
            session()->flash('success', 'Lease draft was successfully updated!');
        } else {
            session()->flash('error', 'Lease draft could not be updated. Please try again.');
            return back();
        }
        return redirect()
            ->route($this->_config['redirect']);
    }


    public function destroy(Lease $lease)
    {
        // delete lease only if no payments has been made on it and is not signed
        // delete the lease tenants
        // delete the lease rents
        // delete the lease charges
        try {
            $lease->delete();
            // delete all rents
            $lease->rents()->delete();
            // delete all charges
            $lease->charges()->delete();
            session()->flash('success', 'Lease record was successfully deleted!');

        } catch ( \Exception $exception) {
            session()->flash('error', 'An error occurred. Please try again');
        }
        return redirect()->route($this->_config['redirect']);
        // if any payment has been made, lease cant be deleted.
        // delete the lease and all rents and charges attached to it.
    }


    public function tenants(Lease $lease)
    {
        $tenants = $this->tenantRepository
            ->findWhere(['company_id' => auth()->user()->company_id],[
                'first_name','last_name','id'
            ])
            ->pluck('full_name', 'id');

        $lease_tenants = $lease->tenants()->pluck('tenant_id');
        $tenants = $tenants->except($lease_tenants);


        return view($this->_config['view'])
            ->with(compact('lease',
                'tenants'));
    }


    public function addTenants(Request $request, Lease $lease)
    {
        $request->validate([
            'tenants_id' => 'required'
        ]);

        foreach ($request->input('tenants_id') as $tenant_id) {
            $lease->tenants()->create(['tenant_id' => $tenant_id]);
        }
        session()->flash('success', 'Tenants was successfully added');

        return back();
    }

    public function detachTenant(LeaseTenant $leaseTenant)
    {
        try {
            $leaseTenant->delete();
            session()->flash('success', 'Tenant was successfully removed.');

        } catch (\Exception $exception) {
            session()->flash('error', 'Tenant could not be removed. Please try again.');
        }

        return back();
    }

}
