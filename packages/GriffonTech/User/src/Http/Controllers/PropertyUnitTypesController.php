<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Property\Repositories\PropertyUnitAmenityRepository;
use GriffonTech\Property\Repositories\PropertyUnitTypeRepository;
use GriffonTech\Unit\Repositories\AmenityRepository;
use GriffonTech\Unit\Repositories\UnitTypeRepository;
use Illuminate\Http\Request;

class PropertyUnitTypesController extends Controller
{

    protected $_config;

    protected $propertyUnitTypeRepository;

    protected $unitTypeRepository;

    protected $amenityRepository;

    protected $propertyUnitAmenityRepository;


    public function __construct(
        PropertyUnitTypeRepository $propertyUnitTypeRepository,
        UnitTypeRepository $unitTypeRepository,
        AmenityRepository $amenityRepository,
        PropertyUnitAmenityRepository $propertyUnitAmenityRepository
    )
    {
        $this->_config = request('_config');

        $this->propertyUnitTypeRepository = $propertyUnitTypeRepository;

        $this->unitTypeRepository = $unitTypeRepository;

        $this->amenityRepository = $amenityRepository;

        $this->propertyUnitAmenityRepository = $propertyUnitAmenityRepository;
    }

    public function index($property_id)
    {
        $propertyUnitTypes = $this->propertyUnitTypeRepository
            ->with(['unit_type'])
            ->findWhere(['property_id' => $property_id]);

        return view($this->_config['view'])
            ->with(compact('propertyUnitTypes', 'property_id'));
    }

    public function create($property_id)
    {
        $unitTypes = $this->unitTypeRepository->pluck('type', 'id')->toArray();

        $amenities = $this->amenityRepository->pluck('type', 'id')->toArray();

        return view($this->_config['view'])->with(compact('property_id',
            'unitTypes', 'amenities'));
    }


    public function store(Request $request, $property_id)
    {
        $request->validate([
            'unit_type_id' => 'required',
            'amount' => 'required'
        ]);
        $newData = $request->only(['unit_type_id', 'amount']);
        $newData['property_id'] = $property_id;

        $property_unit_type = $this->propertyUnitTypeRepository
            ->create($newData);

        if ($property_unit_type) {
            foreach ($request->input('amenities') as $amenity_id) {
                $property_unit_type->unit_amenities()
                    ->create([
                        'property_unit_type_id' => $property_unit_type->id,
                        'amenity_id' => $amenity_id,
                    ]);
            }
            session()->flash('success', 'Property unit type was successfully added!');
        } else {
            session()->flash('error', 'Property unit type could not be added.Please try again');
        }
        return redirect()->route($this->_config['redirect'], $property_id);
    }


    public function show($id)
    {
        $property_unit_type = $this->propertyUnitTypeRepository
            ->with(['unit_type', 'unit_amenities'])
            ->find($id);

        return view($this->_config['view'])
            ->with(compact('property_unit_type'));
    }



    public function edit($id)
    {

        $property_unit_type = $this->propertyUnitTypeRepository
            ->find($id);

        $unitTypes = $this->unitTypeRepository->pluck('type', 'id')->toArray();

        $amenities = $this->amenityRepository->pluck('type', 'id')->toArray();

        $unitAmenities = $this->propertyUnitAmenityRepository
            ->findWhere([
            'property_unit_type_id' => $property_unit_type->id
        ])->pluck('amenity_id')->toArray();


        return view($this->_config['view'])->with(compact('unitTypes',
            'amenities', 'property_unit_type', 'unitAmenities'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'unit_type_id' => 'required',
            'amount' => 'required'
        ]);

        $property_unit_type = $this->propertyUnitTypeRepository->update($request->all(), $id);

        $property_unit_type->unit_amenities()->sync($request->input('amenities'));

        if ($property_unit_type) {
            session()->flash('success', 'Property unit type was successfully updated');
        } else {
            session()->flash('error', 'Property unit type could not be updated. Please try again');
        }
        return redirect()->route($this->_config['redirect'], $property_unit_type->property_id);
    }


    public function destroy()
    {

    }
}
