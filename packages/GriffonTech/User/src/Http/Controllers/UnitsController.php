<?php


namespace GriffonTech\User\Http\Controllers;


use Carbon\Carbon;
use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Property\Repositories\PropertyUnitTypeRepository;
use GriffonTech\Unit\Repositories\UnitRepository;
use GriffonTech\Unit\Repositories\UnitUtilityRepository;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

class UnitsController extends Controller
{

    protected $_config;

    protected $unitRepository;
    protected $propertyRepository;
    protected $unitUtilityRepository;

    public function __construct(
        UnitRepository $unitRepository,
        PropertyRepository $propertyRepository,
        UnitUtilityRepository $unitUtilityRepository
    )
    {
        $this->_config = request('_config');

        $this->unitRepository = $unitRepository;

        $this->propertyRepository = $propertyRepository;
        $this->unitUtilityRepository = $unitUtilityRepository;
    }

    public function index()
    {
        $property_id = \request()->property_id;

        if (!$property_id) {
            // return back to properties.
            return redirect()
                ->route('user.properties.index');
        }
        $property = $this->propertyRepository->find($property_id);

        $units = $this->unitRepository->findWhere([
            'property_id' => $property->id
        ]);

        // if the request is from an ajax call
        if (\request()->ajax()) {
            return $units->toArray();
        }

        return view($this->_config['view'])
            ->with(compact('property', 'units'));
    }


    public function create()
    {
        $property = null;
        if (\request()->property_id) {
            $property = $this->propertyRepository->find(\request()->property_id);
        }

        $countries = Countries::all()
            ->sortBy('name.common')
            ->pluck('name.common', 'cca3')
            ->toArray();
        $countries = ['' => ''] + $countries;
        $states = Countries::all()
            ->map(function($value) {
                return $value->hydrateStates()->states->pluck('extra.name_en', 'postal');
            })->toJson();

        return view($this->_config['view'])
            ->with(compact('property', 'countries', 'states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
        ]);

        $new_data = $request->input();
        $unit = $this->unitRepository->create($new_data);

        if ($unit) {
            session()->flash('success', 'New unit was successfully added!');
        } else {
            session()->flash('error', 'New unit could not be added!');
        }

        return redirect()
            ->route('manager.properties.units.index', ['property_id' => $new_data['property_id']]);
    }

    public function edit($id)
    {
        $unit = $this->unitRepository
            ->findOrFail($id);

        $countries = Countries::all()
            ->sortBy('name.common')
            ->pluck('name.common', 'cca3')
            ->toArray();
        $countries = ['' => ''] + $countries;
        $states = Countries::all()
            ->map(function($value) {
                return $value->hydrateStates()->states->pluck('extra.name_en', 'postal');
            })->toJson();

        $bath_rooms = $this->unitUtilityRepository->getBathRooms();
        $rooms = $this->unitUtilityRepository->getRooms();

        return view($this->_config['view'])
            ->with(compact('unit',
                'countries',
                'states',
                'rooms',
            'bath_rooms'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'identifier' => 'required'
        ]);

        $unit = $this->unitRepository->update($request->all(), $id);

        if ($unit) {
            session()->flash('success', 'Unit was successfully updated!');
        } else {
            session()->flash('error', 'Unit could not be updated');
            return back();
        }
        return redirect()
            ->route('manager.properties.units.show', [
                'property_id' => $unit->property_id,
                'id'=> $unit->id]);
    }


    public function show($id)
    {
        if (!\request()->property_id) {
            return redirect()
                ->route('user.properties.index');
        }

        $unit = $this->unitRepository
            ->find($id);

        $property = $this->propertyRepository
            ->find($unit->property_id);

        $bath_rooms = $this->unitUtilityRepository->getBathRooms();
        $rooms = $this->unitUtilityRepository->getRooms();

        if (\request()->expectsJson()) {
            return response()
                ->json([ 'data' => $unit->toArray()]);
        }

        return view($this->_config['view'])
            ->with(compact('unit',
                'property',
                'bath_rooms', 'rooms'));
    }

    public function destroy()
    {
        // delete an assigned unit.
        // Thanks for checking.
    }

}
