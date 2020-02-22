<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Property\Repositories\PropertyRepository;
use Illuminate\Http\Request;

class PropertiesController
{

    protected $_config;

    protected $PropertyTypes = [
        '' => '--Select Property Type',
        'self_con' => 'Self Contain',
        '2_bed_room' => '2 bed Room Apartment',
        '3_bed_room' => '3 bed Room Apartment',
        'lock_up_store' => 'Lock Up Stores',
        'warehouse' => 'WareHouse',
    ];

    protected $propertyRepository;

    public function __construct(
        PropertyRepository $propertyRepository
    )
    {
        $this->_config = request('_config');

        $this->propertyRepository = $propertyRepository;
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

}
