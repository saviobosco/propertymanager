<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Tenant\Repositories\TenantRepository;
use GriffonTech\Unit\Repositories\UnitRentPaymentRepository;
use GriffonTech\Unit\Repositories\UnitRepository;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $_config;

    protected $propertyRepository;

    protected $unitRepository;

    protected $tenantRepository;


    public function __construct()
    {
        $this->_config = request('_config');
    }

    public function index()
    {
        return view($this->_config['view']);
    }

}
