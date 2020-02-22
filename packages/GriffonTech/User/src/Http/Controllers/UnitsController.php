<?php


namespace GriffonTech\User\Http\Controllers;


use Carbon\Carbon;
use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Unit\Repositories\UnitRepository;
use Illuminate\Http\Request;

class UnitsController extends Controller
{

    protected $_config;

    protected $unitRepository;

    protected $propertyRepository;

    public function __construct(
        UnitRepository $unitRepository,
        PropertyRepository $propertyRepository
    )
    {
        $this->_config = request('_config');

        $this->unitRepository = $unitRepository;

        $this->propertyRepository = $propertyRepository;
    }

    public function index()
    {
        $units = $this->unitRepository->getModel()
            ->with(['property', 'tenants:id,first_name,last_name,unit_id'])
            ->join('properties', 'properties.id', '=', 'units.property_id')
            ->where('properties.user_id', auth()->user()->id)
            ->select('units.*', 'properties.id')
            ->get();

        return view($this->_config['view'])->with(['units' => $units]);
    }

    public function create()
    {
        $propertySelectValues = $this->propertyRepository->pluck('name' , 'id');

        return view($this->_config['view'])->with(compact('propertySelectValues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
        ]);

        $unit = $this->unitRepository->create($request->all());
        if ($unit) {
            session()->flash('success', 'New unit was successfully added!');
        } else {
            session()->flash('error', 'New unit could not be added!');
        }

        return redirect()->route($this->_config['redirect']);
    }

    public function edit($id)
    {
        $unit = $this->unitRepository
            ->with(['property'])
            ->findOrFail($id);

        return view($this->_config['view'])->with(compact('unit'));
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
        }
        return redirect()->route($this->_config['redirect']);
    }

    public function show($id)
    {
        $unit = $this->unitRepository
            ->with(['tenants'])
            ->find($id);

        if (\request()->expectsJson()) {
            return response()
                ->json([ 'data' => $unit->toArray()]);
        }

        return view($this->_config['view'])->with(compact('unit'));
    }
}
