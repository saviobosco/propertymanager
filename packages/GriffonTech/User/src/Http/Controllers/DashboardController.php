<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Tenant\Repositories\TenantRepository;
use GriffonTech\Unit\Repositories\UnitRepository;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $_config;

    protected $propertyRepository;

    protected $unitRepository;

    protected $tenantRepository;

    public function __construct(
        PropertyRepository $propertyRepository,
        UnitRepository $unitRepository,
        TenantRepository $tenantRepository
    )
    {
        $this->_config = request('_config');

        $this->propertyRepository = $propertyRepository;

        $this->unitRepository = $unitRepository;

        $this->tenantRepository = $tenantRepository;
    }

    public function index()
    {
        $propertiesCount = $this->propertyRepository
            ->findWhere(['user_id' => auth()->user()->id])
            ->count();

        $property_ids =  $this->propertyRepository
            ->findWhere(['user_id' => auth()->user()->id])
            ->pluck('id')->toArray();

        $unitsCount = $this->unitRepository
            ->findWhereIn('property_id',$property_ids)
            ->count();

        $unit_ids =  $this->unitRepository
            ->findWhereIn('property_id', $property_ids)
            ->pluck('id')->toArray();

        $tenantsCount = $this->tenantRepository
            ->findWhereIn('unit_id', $unit_ids)
            ->count();

        $unitsToExpireSoon = $this->unitRepository
            ->getModel()
            ->with(['property'])
            ->whereIn('property_id', $property_ids)
            ->whereBetween('lease_ends',
                [DB::raw('CURDATE()'),
                    DB::raw('CURDATE() + INTERVAL 60 DAY')
                ])
            ->get()
            ->groupBy('property.name');

        return view($this->_config['view'])
            ->with(compact('unitsCount',
                'propertiesCount', 'tenantsCount', 'unitsToExpireSoon'));
    }

}
