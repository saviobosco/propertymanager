<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Property\Repositories\PropertyOwnerRepository;
use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Property\Repositories\PropertyTypeRepository;
use GriffonTech\Property\Repositories\PropertyUnitTypeRepository;
use GriffonTech\Property\Repositories\RentalOwnerPropertyRepository;
use GriffonTech\Tenant\Repositories\TenantRepository;
use GriffonTech\Unit\Repositories\UnitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PragmaRX\Countries\Package\Countries;

class PropertiesController
{

    protected $_config;

    protected $PropertyTypes;

    protected $propertyRepository;
    protected $tenantRepository;
    protected $rentalOwnerPropertyRepository;
    protected $propertyTypeRepository;
    protected $propertyOwnerRepository;
    protected $unitRepository;

    protected $countries;

    public function __construct(
        PropertyRepository $propertyRepository,
        TenantRepository $tenantRepository,
        PropertyTypeRepository $propertyTypeRepository,
        RentalOwnerPropertyRepository $rentalOwnerPropertyRepository,
        PropertyOwnerRepository $propertyOwnerRepository,
        UnitRepository $unitRepository
    )
    {
        $this->_config = request('_config');

        $this->propertyRepository = $propertyRepository;

        $this->tenantRepository = $tenantRepository;

        $this->propertyTypeRepository = $propertyTypeRepository;

        $this->rentalOwnerPropertyRepository = $rentalOwnerPropertyRepository;

        $this->propertyOwnerRepository = $propertyOwnerRepository;
        $this->unitRepository = $unitRepository;

        $this->countries = Countries::all()
            ->sortBy('name.common')
            ->pluck('name.common', 'cca3')
            ->toArray();
    }



    public function index()
    {
        $properties = $this->propertyRepository
            ->with(['rental_owners.owner'])
            ->findWhere([
            'user_id' => auth()->user()->id
        ]);

        return view($this->_config['view'])->with(compact('properties'));
    }

    public function create()
    {
        $countries = $this->countries;
        $countries = ['' => ''] + $countries;

        $states = Countries::all()
            ->map(function($value) {
                return $value->hydrateStates()->states->pluck('extra.name_en', 'postal');
            });

        $property_types = $this->propertyTypeRepository
            ->getTypesGroupedByCategory()->toArray();

        return view($this->_config['view'])
            ->with([
                'countries' => $countries,
                'property_types' => $property_types,
                'states' => $states->toJson()
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_type' => 'required',
            'address_line1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'country' => 'required'
        ]);

        $new_data = $request->input();
        $new_data['user_id'] = auth()->user()->id;
        $new_data['company_id'] = auth()->user()->company_id;

        $property = $this->propertyRepository->create($new_data);
        if ($property)
        {
            session()->flash('success', 'New property was added successfully');
        } else {
            session()->flash('error', 'New property could not be added. Please try again later');
        }
        return redirect()
            ->route($this->_config['redirect']);
    }


    public function show($id)
    {
        $property = $this->propertyRepository->findOrFail($id);

        $rental_owner_properties = $this->rentalOwnerPropertyRepository
            ->findWhere(['property_id' => $property->id]);
        $property_owner_ids = $rental_owner_properties
            ->pluck('property_owner_id')
            ->toArray();

        $rental_owner_percentages = $rental_owner_properties
            ->pluck('ownership_percentage', 'property_owner_id');

        $property_owners = $this->propertyOwnerRepository->findWhereIn('id', $property_owner_ids);
        $units = null;
        $leases = null;
        $files = null;

        return view($this->_config['view'])
            ->with(compact('property',
                'property_owners',
                'rental_owner_percentages',
                'units'));
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

    public function getUnits($id)
    {
        return $this->unitRepository->findWhere([
            'property_id' => $id
        ],['identifier', 'id'])->pluck('identifier', 'id');

    }
}
