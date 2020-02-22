<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Tenant\Repositories\TenantRepository;
use GriffonTech\Unit\Repositories\UnitRepository;
use Illuminate\Http\Request;

class TenantsController extends Controller
{

    protected $_config;

    protected $tenantRepository;

    protected $unitRepository;

    protected $propertyRepository;

    public function __construct(
        TenantRepository $tenantRepository,
        UnitRepository $unitRepository,
        PropertyRepository $propertyRepository
    )
    {
        $this->_config = request('_config');

        $this->tenantRepository = $tenantRepository;

        $this->unitRepository = $unitRepository;

        $this->propertyRepository = $propertyRepository;
    }

    public function index()
    {
        $unit_id = \request()->route('unit_id');

        if ($unit_id) {
            $tenants = $this->tenantRepository
                ->with(['property', 'unit'])
                ->findWhere([
                    'unit_id' => $unit_id,
                    ]);
        } else {
            $property_ids = $this->propertyRepository->findByField('user_id', auth()->user()->id)
                ->pluck('id')->toArray();
            if ($property_ids) {
                $unit_ids = $this->unitRepository->findWhereIn('property_id', $property_ids)
                    ->pluck('id')->toArray();
                if ($unit_ids) {
                    $tenants = $this->tenantRepository->findWhereIn('unit_id', $unit_ids);
                }
            }
        }
        return view($this->_config['view'])
            ->with(compact('units', 'tenants'));
    }

    public function create()
    {
        $unit_id = \request()->route('id');

        if ($unit_id) {
            $unit = $this->unitRepository->findOrFail($unit_id);
        } else {
            $property_ids = $this->propertyRepository->findByField('user_id', auth()->user()->id)
                ->pluck('id')->toArray();
            if ($property_ids) {
                $units = $this->unitRepository->findWhereIn('property_id', $property_ids)
                    ->pluck('identifier', 'id')->prepend('--Select Unit--', '')->toArray();
            }
        }
        return view($this->_config['view'])->with(compact('unit', 'units'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'occupation' => 'required',
        ]);

        $unit = $this->unitRepository->findOrFail($request->input('unit_id'));

        $newData = $request->all();
        $newData['property_id'] = $unit->property_id;

        $tenant = $this->tenantRepository->create($newData);
        if ($tenant) {
            session()->flash('success', 'Tenant record was successfully added');
        } else {
            session()->flash('error', 'Tenant record could not be added. Please try again');
        }
        if ($request->input('add_another_tenant')) {
            if ($request->route('id')) {
                return redirect()->route('user.units.tenants.create', $newData['unit_id']);
            }
            return redirect()->route('user.tenants.create');
        }
        if ($request->input('id')) {
            return redirect()->route($this->_config['redirect'], $newData['unit_id']);
        }
        return redirect()->route($this->_config['redirect']);

    }


    public function show($id)
    {
        $tenant = $this->tenantRepository->with(['property', 'unit'])
            ->findOrFail($id);

        return view($this->_config['view'])
            ->with(compact('tenant'));
    }


    public function edit($id)
    {
        $tenant = $this->tenantRepository->with(['unit'])
            ->findOrFail($id);

        return view($this->_config['view'])
            ->with(compact('tenant'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'occupation' => 'required',
        ]);

        $updateData = $request->except(['unit_id', 'property_id']);

        $tenant = $this->tenantRepository->update($updateData, $id);

        if ($tenant) {
            session()->flash('success', 'Tenant was successfully updated!');
        } else {
            session()->flash('error', 'Tenant record could not be updated');
        }
        return redirect()->route($this->_config['redirect']);
    }


    public function destroy($id)
    {
        if ($this->tenantRepository->delete($id)) {
            session()->flash('success', 'Tenant was successfully deleted');
        } else {
            session()->flash('error', 'Tenant could not be deleted. Please try again later');
        }
        if (\request()->isXmlHttpRequest()) {
            return response()->json(['redirect' => url()->route($this->_config['redirect']) ]);
        }
        return redirect()
            ->route($this->_config['redirect']);
    }
}
