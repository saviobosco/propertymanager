<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Core\Repositories\TaskCategoryRepository;
use GriffonTech\Core\Repositories\TaskRepository;
use GriffonTech\Property\Repositories\PropertyOwnerRepository;
use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Tenant\Repositories\TenantRepository;
use GriffonTech\Unit\Repositories\LeaseTenantRepository;

class RecurringTasksController extends Controller
{
    protected $_config;
    protected $taskCategoryRepository;
    protected $tenantRepository;
    protected $propertyOwnerRepository;
    protected $leaseTenantRepository;
    protected $taskRepository;
    protected $propertyRepository;


    public function __construct(
        TaskCategoryRepository $taskCategoryRepository,
        TenantRepository $tenantRepository,
        PropertyOwnerRepository $propertyOwnerRepository,
        LeaseTenantRepository $leaseTenantRepository,
        TaskRepository $taskRepository,
        PropertyRepository $propertyRepository
    )
    {
        $this->taskCategoryRepository = $taskCategoryRepository;
        $this->tenantRepository = $tenantRepository;
        $this->propertyOwnerRepository = $propertyOwnerRepository;
        $this->leaseTenantRepository = $leaseTenantRepository;
        $this->taskRepository = $taskRepository;
        $this->propertyRepository = $propertyRepository;

        $this->_config = request('_config');
    }


    public function index()
    {
        $taskTypes = $this->taskRepository->getTypes();
        $taskStatuses = $this->taskRepository->getStatuses();
        $taskPriorities = $this->taskRepository->getPriorities();

        $tasks = $this->taskRepository
            ->findWhere([
                'company_id' => auth()->user()->company_id,
                'is_recurring' => 1
            ]);

        return view($this->_config['view'])
            ->with(compact('tasks',
                'taskTypes',
                'taskStatuses',
                'taskPriorities'));
    }


    public function create()
    {
        $taskTypeId = \request()->get('taskTypeId');

        if (empty($taskTypeId)) {
            return redirect()->route('user.tasks.index');
        }

        $renderedData = [];

        if ((int) $taskTypeId === 1 ) {

            $tenants = $this->leaseTenantRepository
                ->all()
                ->map(function($row){
                    $row->key = $row->tenant_id;
                    $row->value = $row->tenant->full_name.', '.
                        $row->lease->property->address.' - '.
                        $row->lease->unit->identifier;
                    return $row;
                })
                ->pluck('value', 'key')
                ->toArray();

            $renderedData['tenants'] = $tenants;
        }

        if ((int) $taskTypeId === 2) {
            $rentalOwners = $this->propertyOwnerRepository
                ->all(['id','first_name', 'last_name', 'company_name'])
                ->map(function ($row) {
                    $row->key = $row->id;
                    $row->value = (!empty($row->company_name)) ? $row->company_name : $row->first_name. ' '. $row->last_name;
                    return $row;
                })
                ->pluck('value', 'key')
                ->toArray();

            $renderedData['rentalOwners'] = $rentalOwners;
        }
        if ((int) $taskTypeId === 3 || (int) $taskTypeId === 4) {
            $properties = $this->propertyRepository->all()
                ->pluck('address', 'id')
                ->prepend( 'select property...', '');

            $renderedData['properties'] = $properties;
        }

        $taskCategories = $this->taskCategoryRepository
            ->pluck('name', 'id');
        $renderedData['taskCategories'] = $taskCategories;
        $renderedData['taskTypeId'] = $taskTypeId;

        return view($this->_config['view'], $renderedData);
    }

}
