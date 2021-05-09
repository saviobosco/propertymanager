<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Core\Repositories\CountryRepository;
use GriffonTech\Property\Models\PropertyOwner;
use GriffonTech\Property\Repositories\PropertyOwnerRepository;
use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Property\Repositories\RentalOwnerPropertyRepository;
use Illuminate\Http\Request;

class RentalOwnersController extends Controller
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
        $propertyOwners = $this->propertyOwnerRepository
            ->findWhere([
                'company_id' => auth()->user()->company_id
            ]);

        return view($this->_config['view'])
            ->with(compact('propertyOwners'));
    }


    public function create()
    {
        $countries =['' => ''] + $this->countryRepository->listArray();

        $states = $this->countryRepository->getStatesJson();

        $properties = $this->propertyRepository
            ->pluck('address_line1', 'id');

        return view($this->_config['view'])
            ->with(compact('countries',
                'states', 'properties'));
    }


    public function store(Request $request)
    {
        // storing a new property owner.
        $this->validate($request, [
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

        if ($rental_owner) {
            $new_properties = $request
                ->input('new_property');

            if (!empty($new_properties)) {
                foreach ($new_properties as $new_property) {
                    $property_exists = $this->rentalOwnerPropertyRepository
                        ->findWhere([
                            'property_id' => $new_property['id'],
                            'property_owner_id' => $rental_owner->id
                        ])->first();

                    if (!$property_exists) {
                        $this->rentalOwnerPropertyRepository->create([
                            'property_id' => $new_property['id'],
                            'property_owner_id' => $rental_owner->id,
                            'ownership_percentage' => $new_property['ownership_percentage']
                        ]);
                    }
                }
            }
            session()->flash('success', 'Rental owner was successfully created.');
        } else {
            session()->flash('error', 'Rental owner could not be created. please try again.');
            return back()->withInput();
        }
        return redirect()->route('manager.rental_owners.index');
    }


    public function edit(PropertyOwner $propertyOwner)
    {
        // editing a new property owner
    }


    public function update(Request $request)
    {
        // updating a new property owner
    }



    public function destroy(PropertyOwner $propertyOwner)
    {

    }


    public function ownerProperties(PropertyOwner $propertyOwner)
    {
        return $propertyOwner->properties()->get()
            ->pluck('property.address', 'property_id');
    }
}
