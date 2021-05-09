<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Core\Repositories\CountryRepository;
use GriffonTech\Property\Models\PropertyOwner;
use GriffonTech\Property\Repositories\PropertyOwnerRepository;
use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Property\Repositories\RentalOwnerPropertyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PragmaRX\Countries\Package\Countries;

class PropertyOwnersController extends Controller
{
    protected $_config;
    protected $propertyOwnerRepository;
    protected $countryRepository;
    protected $rentalOwnerPropertyRepository;
    protected $propertyRepository;

    public function __construct(
        PropertyOwnerRepository $propertyOwnerRepository,
        CountryRepository $countryRepository,
        RentalOwnerPropertyRepository $rentalOwnerPropertyRepository,
        PropertyRepository $propertyRepository
    )
    {
        $this->_config = \request('_config');
        $this->propertyOwnerRepository = $propertyOwnerRepository;
        $this->countryRepository = $countryRepository;
        $this->rentalOwnerPropertyRepository = $rentalOwnerPropertyRepository;
        $this->propertyRepository = $propertyRepository;
    }


    public function index()
    {
        $request = request();
        $property_id = $request->property_id;
        $property_owners = null;
        if ($property_id) {
            $rental_owner_ids = $this->rentalOwnerPropertyRepository
                ->findWhere(['property_id' => $property_id])
                ->pluck('property_owner_id')
                ->toArray();

            $property_owners = $this->propertyOwnerRepository
                ->findWhereIn('id', $rental_owner_ids);
        }

        $viewData = [];
        $viewData['property_owners'] = $property_owners;
        ($property_id) ? $viewData['property_id'] = $property_id : null;

        return view($this->_config['view'])
            ->with($viewData);
    }

    public function create()
    {
        $request = request();
        $property_id = $request->property_id;

        $countries = $this->countryRepository->listArray();

        $countries = ['' => ''] + $countries;

        $states = $this->countryRepository->getStatesJson();

        return view($this->_config['view'])
            ->with([
                'property_id' => $property_id,
                'countries' => $countries,
                'states' => $states]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'property_id' => 'required|numeric',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'company_name' => 'nullable|required_if:first_name,=,null',
            'date_of_birth' => 'nullable|date',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'address_line1' => 'nullable'
        ]);

        $new_data = $request->all();
        $new_data['company_id'] = auth()->user()->company_id;
        $rental_owner = $this->propertyOwnerRepository->create($new_data);
        $this->rentalOwnerPropertyRepository->create([
            'property_id' => $request->get('property_id'),
            'property_owner_id' => $rental_owner->id,
            'ownership_percentage' => $request->get('ownership_percentage')
        ]);

        if ($rental_owner) {
            session()->flash('success', 'Rental owner was successfully created.');
        } else {
            session()->flash('error', 'Rental owner could not be created. please try again.');
            return back()->withInput();
        }
        return redirect()->route('user.property_owners.index', [
            'property_id' => $request->get('property_id')]);
    }


    public function edit(PropertyOwner $propertyOwner)
    {
        $countries = $this->countryRepository->listArray();

        $countries = ['' => ''] + $countries;

        $states = $this->countryRepository->getStatesJson();

        $owned_properties = $this->rentalOwnerPropertyRepository
            ->findWhere(['property_owner_id' => $propertyOwner->id]);

        $properties = $this->propertyRepository->pluck('address_line1', 'id');

        return view($this->_config['view'])
            ->with(compact('propertyOwner',
                'states',
                'countries', 'owned_properties', 'properties'));

    }

    public function update(Request $request, PropertyOwner $propertyOwner)
    {

        $this->validate($request, [
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'company_name' => 'nullable|required_if:first_name,=,null',
            'date_of_birth' => 'nullable|date',
            'agreement_start_date' => 'nullable|date',
            'agreement_end_date' => 'nullable|date',
            'address_line1' => 'required'
        ]);

        $propertyOwner->fill($request->input());
        if ($propertyOwner->update()) {
            $owned_properties = $request->input('owned_property');

            if (!empty($owned_properties)) {
                foreach ($owned_properties as $owned_property) {
                    $stored_property = $this->rentalOwnerPropertyRepository->find($owned_property['id']);
                    $stored_property->fill([
                        'ownership_percentage' => $owned_property['ownership_percentage']
                            ]);

                    if ($stored_property->isDirty()) {
                        $stored_property->update();
                    }
                }
            }
            $new_properties = $request->input('new_property');
            if (!empty($new_properties)) {
                foreach ($new_properties as $new_property) {
                    $property_exists = $this->rentalOwnerPropertyRepository
                        ->findWhere([
                            'property_id' => $new_property['id'],
                            'property_owner_id' => $propertyOwner->id
                        ])->first();

                    if (!$property_exists) {
                        $this->rentalOwnerPropertyRepository->create([
                            'property_id' => $new_property['id'],
                            'property_owner_id' => $propertyOwner->id,
                            'ownership_percentage' => $new_property['ownership_percentage']
                        ]);
                    }
                }
            }
            // loop through the system, check if the record is dirty
            session()->flash('success', 'Rental owner was successfully updated!');
        } else {
            session()->flash('error', 'Rental owner could not be updated.Please try again.');
        }
        return back();
    }


    public function destroy(PropertyOwner $propertyOwner)
    {
        try {
            DB::beginTransaction();
            $owned_properties = $this->rentalOwnerPropertyRepository
                ->findWhere(['property_owner_id' => $propertyOwner->id]);

            if ($owned_properties->isNotEmpty()) {
                foreach ($owned_properties as $owned_property) {
                    $owned_property->delete();
                }
            }
            $propertyOwner->delete();
            DB::commit();
            session()->flash('success', 'Property owner was successfully deleted.');
        } catch (\Exception $exception) {
            DB::rollBack();
            session()->flash('error', 'Property owner could not be deleted. Please try again.');
        }
        return back();
    }
}
