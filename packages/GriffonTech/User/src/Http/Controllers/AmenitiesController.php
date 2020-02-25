<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Unit\Repositories\AmenityRepository;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{

    protected $_config;

    protected $amenityRepository;


    public function __construct(
        AmenityRepository $amenityRepository
    )
    {
        $this->_config = request('_config');

        $this->amenityRepository = $amenityRepository;
    }

    public function index()
    {
        $amenities = $this->amenityRepository->all();

        return view($this->_config['view'])
            ->with(compact('amenities'));
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

        $amenity = $this->amenityRepository->create($request->all());

        if ($amenity) {
            session()->flash('success', 'Amenity was successfully added');
        } else {
            session()->flash('error', 'Amenity could not be added. Please try again!');
        }

        return redirect()->route($this->_config['redirect']);
    }

    public function show()
    {

    }


    public function edit($id)
    {
        $amenity = $this->amenityRepository->find($id);

        return view($this->_config['view'])
            ->with(compact('amenity'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required'
        ]);

        $amenity = $this->amenityRepository->update($request->all(), $id);
        if ($amenity) {
            session()->flash('success', 'Amenity was successfully updated');
        } else {
            session()->flash('error', 'Amenity could not be updated.Please try again');
        }
        return redirect()->route($this->_config['redirect']);
    }


    public function destroy($id)
    {
        try {
            if ($this->amenityRepository->delete($id)) {
                session()->flash('success', 'Amenity was successfully deleted');
            } else {
                session()->flash('error', 'Amenity could not be deleted.Please try again');
            }
        } catch ( \Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }
        return redirect()->route($this->_config['redirect']);
    }

}
