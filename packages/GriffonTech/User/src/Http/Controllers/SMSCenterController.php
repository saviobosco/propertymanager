<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Tenant\Repositories\TenantRepository;
use GriffonTech\Unit\Repositories\UnitRepository;

class SMSCenterController extends Controller
{
    protected $_config;

    protected $tenantRepository;

    protected $unitRepository;

    protected $propertyRepository;

    public function __construct(
        TenantRepository $tenantRepository,
        PropertyRepository $propertyRepository,
        UnitRepository $unitRepository
    )
    {
        $this->_config = request('_config');

        $this->tenantRepository = $tenantRepository;

        $this->unitRepository = $unitRepository;

        $this->propertyRepository = $propertyRepository;
    }

    public function index()
    {

    }

    public function create()
    {
        $properties = $this->propertyRepository
        ->findWhere(['user_id' => auth()->user()->id])
            ->pluck('name', 'id');

        return view($this->_config['view'])->with(compact('properties'));
    }

}
