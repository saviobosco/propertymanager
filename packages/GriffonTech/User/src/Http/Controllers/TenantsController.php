<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Core\Repositories\CountryRepository;
use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Tenant\Repositories\TenantRepository;
use GriffonTech\Unit\Repositories\UnitRepository;
use Illuminate\Http\Request;
//use GriffonTech\Tenant\Models\Tenant;
class TenantsController extends Controller
{

    protected $_config;

    protected $tenantRepository;

    protected $unitRepository;

    protected $propertyRepository;
    protected $countryRepository;

    public function __construct(
        TenantRepository $tenantRepository,
        UnitRepository $unitRepository,
        PropertyRepository $propertyRepository,
        CountryRepository $countryRepository
    )
    {
        $this->_config = request('_config');

        $this->tenantRepository = $tenantRepository;

        $this->unitRepository = $unitRepository;

        $this->propertyRepository = $propertyRepository;

        $this->countryRepository = $countryRepository;
    }

    public function index()
    {
        $tenants = $this->tenantRepository
            ->findWhere([
                'company_id' => auth()->user()->company_id
            ]);

        return view($this->_config['view'])
            ->with(compact('tenants'));
    }

    public function create()
    {
        $countries = ['' => ''] + $this->countryRepository->listArray();
        $states = $this->countryRepository->getStatesJson();

        return view($this->_config['view'])
            ->with(compact('countries', 'states'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $newData = $request->input();
        $newData['company_id'] = auth()->user()->company_id;
        $tenant = $this->tenantRepository
            ->create($newData);
        if ($tenant) {
            session()->flash('success', 'Tenant was successfully added.');
        } else {
            session()->flash('error', 'Tenant could not be added. Please try again.');
        }
        return redirect()
            ->route($this->_config['redirect']);
    }


    public function show($id)
    {
        $tenant = $this->tenantRepository->with(['property', 'unit'])
            ->findOrFail($id);

        return view($this->_config['view'])
            ->with(compact('tenant'));
    }


    public function edit($id)
    {
        $tenant = $this->tenantRepository
            ->findOrFail($id);

        $countries = ['' => ''] + $this->countryRepository->listArray();
        $states = $this->countryRepository->getStatesJson();

        return view($this->_config['view'])
            ->with(compact('tenant',
                'countries',
                'states'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $tenant = $this->tenantRepository
            ->update($request->input(), $id);

        if ($tenant) {
            session()->flash('success', 'Tenant was successfully updated!');
        } else {
            session()->flash('error', 'Tenant record could not be updated');
        }
        return redirect()->route($this->_config['redirect']);
    }


    public function destroy($id)
    {
        try {
            $this->tenantRepository->delete($id);
            session()->flash('success', 'Tenant was successfully deleted');
        } catch (\Exception $exception) {
            session()->flash('error', 'an error occurred. Please try again.');
        }
        if (\request()->isXmlHttpRequest()) {
            return response()->json(['redirect' => url()->route($this->_config['redirect']) ]);
        }
        return redirect()
            ->route($this->_config['redirect']);
    }
}
