<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Unit\Repositories\UnitTypeRepository;
use Illuminate\Http\Request;

class UnitTypesController extends Controller
{

    protected $_config;

    protected $unitTypeRepository;

    public function __construct(
        UnitTypeRepository $unitTypeRepository
    )
    {
        $this->_config = request('_config');

        $this->unitTypeRepository = $unitTypeRepository;
    }

    public function index()
    {
        $unit_types = $this->unitTypeRepository->all();

        return view($this->_config['view'])
            ->with(compact('unit_types'));
    }

    public function create()
    {
        return view($this->_config['view']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required'
        ]);

        $unit_type = $this->unitTypeRepository->create($request->all());

        if ($unit_type) {
            session()->flash('success', 'Unit Type was successfully added!');
        } else {
            session()->flash('error', 'Unit type could not be added. Please try again');
        }
        return redirect()->route($this->_config['redirect']);
    }

    public function edit($id)
    {
        $unit_type = $this->unitTypeRepository->find($id);

        return view($this->_config['view'])
            ->with(compact('unit_type'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required'
        ]);
    }

    public function destroy($id)
    {
        if ($this->unitTypeRepository->delete($id)) {
            session()->flash('success', 'Unit type was successfully deleted');
        } else {
            session()->flash('error', 'Unit type could not be deleted. Please try again');
        }
        return redirect()->route($this->_config['redirect']);
    }
}
