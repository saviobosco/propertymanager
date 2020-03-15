<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Property\Repositories\PropertyUnitTypeRepository;
use GriffonTech\Tenant\Repositories\TenantRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertiesController
{

    protected $_config;

    protected $PropertyTypes = PropertyRepository::PROPERTY_TYPES;

    protected $propertyRepository;
    protected $tenantRepository;
    protected $propertyUnitTypeRepository;


    public function __construct(
        PropertyRepository $propertyRepository,
        TenantRepository $tenantRepository,
        PropertyUnitTypeRepository $propertyUnitTypeRepository

    )
    {
        $this->_config = request('_config');

        $this->propertyRepository = $propertyRepository;

        $this->tenantRepository = $tenantRepository;

        $this->propertyUnitTypeRepository = $propertyUnitTypeRepository;
    }



    public function index()
    {
        $properties = $this->propertyRepository
            ->with(['units:id,property_id'])
            ->findWhere([
            'user_id' => auth()->user()->id
        ]);

        return view($this->_config['view'])->with(compact('properties'));
    }

    public function create()
    {
        return view($this->_config['view'])->with(['propertyTypes' => $this->PropertyTypes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required',

        ]);
        $requestData = $request->all();
        $requestData['user_id'] = auth()->user()->id;

        $property = $this->propertyRepository->create($requestData);
        if ($property)
        {
            session()->flash('success', 'Your new property was added successfully');
        } else {
            session()->flash('error', 'Your new property could not be added. Please try again later');
        }
        return redirect()
            ->route($this->_config['redirect']);
    }


    public function show($id)
    {
        $property = $this->propertyRepository->findOrFail($id);

        return view($this->_config['view'])->with(compact('property'));
    }

    public function edit($id)
    {
        $property = $this->propertyRepository->findOrFail($id);

        return view($this->_config['view'], ['propertyTypes' => $this->PropertyTypes])
            ->with(compact('property'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $updateData = $request->all();

        $property = $this->propertyRepository->update($updateData, $id);
        if ($property)
        {
            session()->flash('success', 'Your property was updated successfully');
        } else {
            session()->flash('error', 'Your property could not be updated. Please try again later');
        }
        return redirect()
            ->route($this->_config['redirect']);
    }


    public function destroy($id)
    {
        if ($this->propertyRepository->delete($id)) {
            session()->flash('success', 'Your property was successfully deleted');
        } else {
            session()->flash('error', 'Your property could not be deleted. Please try again later');
        }
        return redirect()
            ->route($this->_config['redirect']);
    }

    public function getTenants($id)
    {
        $searchParam = \request()->query('search_param');

        $tenants = [];

        if ($searchParam === 'less_than_2_months') {
            $tenants = $this->tenantRepository->getModel()
                ->join('units', 'tenants.unit_id', '=', 'units.id')
                ->whereBetween('units.lease_ends',[DB::raw('CURDATE()'),
                    DB::raw('CURDATE() + INTERVAL 60 DAY')
                ])
                ->where('tenants.property_id', $id)
                ->get()->toArray();

        } else if ($searchParam === 'expired') {

           $tenants = $this->tenantRepository->getModel()
               ->join('units', 'tenants.unit_id', '=', 'units.id')
               ->where('tenants.property_id', $id)
               ->where('units.is_occupied', 1)
               ->where('tenants.active', 1)
               ->whereDate('units.lease_ends','<=', DB::raw('CURDATE()'))
               ->get()->toArray();

        }

        if (\request()->expectsJson()) {
            return response()
                ->json([
                    'render' => view($this->_config['view'])->with(compact('tenants'))->render()
                ]);
        }
        return view($this->_config['view'])
            ->with(compact('tenants'));
    }

    public function get_property_unit_types($id)
    {
        $propertyUnitTypes = $this->propertyUnitTypeRepository->with(['unit_type'])
            ->findWhere(['property_id' => $id])
            ->map(function($row){
                $row->type = $row->unit_type->type . ' : ' . $row->amount;
                return $row;
            })
            ->pluck('type', 'id');

        return view($this->_config['view'])
            ->with(compact('propertyUnitTypes'));
    }
}
