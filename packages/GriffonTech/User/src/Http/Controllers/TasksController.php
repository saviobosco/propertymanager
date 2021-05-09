<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Core\Models\Task;
use GriffonTech\Core\Repositories\TaskCategoryRepository;
use GriffonTech\Core\Repositories\TaskRepository;
use GriffonTech\Property\Repositories\PropertyOwnerRepository;
use GriffonTech\Property\Repositories\PropertyRepository;
use GriffonTech\Tenant\Repositories\TenantRepository;
use GriffonTech\Unit\Repositories\LeaseTenantRepository;
use Illuminate\Http\Request;

class TasksController extends Controller
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
            ->findWhere(['company_id' => auth()->user()->company_id]);

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


    public function store(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required',
            'priority' => 'required',
            'type' => 'required'
        ]);

        if ($request->input('type') === 1) {
            $this->validate($request, ['tenant_id' => 'required']);
        } else if ($request->input('type') === 2) {
            $this->validate($request, [
                'rental_owner_id' => 'required',
                'property_id' => 'required'
            ]);

        } else if ($request->input('type') === 4) {
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'primary_email_address' => 'required'
            ]);
        }

        $postData = $request->except(['_token']);
        $postData['company_id'] = auth()->user()->company_id;

        $task = $this->taskRepository->create($postData);
        if ($task) {
            session()->flash('success', 'Task was successfully created.');
        } else {
            session()->flash('error', 'Task could not be created. Please try again.');
            return back()->withInput();
        }
        return redirect()
            ->route($this->_config['redirect']);
    }

    public function edit(Task $task)
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

            // load rental owner properties
            $properties = $task->rental_owner->properties()->get()
                ->pluck('property.address', 'property_id');

            // load property units.
            $units = $task->property->units()->get()
                ->pluck('property.address', 'property_id');

            $renderedData['rentalOwners'] = $rentalOwners;
            $renderedData['properties'] = $properties;
            $renderedData['units'] = $units;
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
        $renderedData['task'] = $task;

        return view($this->_config['view'], $renderedData);
    }


    public function update(Request $request, Task $task)
    {
        $this->validate($request,[
            'subject' => 'required',
            'priority' => 'required',
        ]);

        if ($request->input('type') === 1) {
            $this->validate($request, ['tenant_id' => 'required']);
        } else if ($request->input('type') === 2) {
            $this->validate($request, [
                'rental_owner_id' => 'required',
                'property_id' => 'required'
            ]);

        } else if ($request->input('type') === 4) {
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'primary_email_address' => 'required'
            ]);
        }

        $postData = $request->except(['_token']);

        $task = $task->update($postData);
        if ($task) {
            session()->flash('success', 'Task was successfully updated.');
        } else {
            session()->flash('error', 'Task could not be updated. Please try again.');
            return back()->withInput();
        }
        return redirect()
            ->route($this->_config['redirect']);
    }



    public function destroy(Task $task)
    {
        try {
            $task->delete();
            session()->flash('success', 'Task was successfully deleted.');
        } catch (\Exception $exception) {
            session()->flash('error', 'Task could not be deleted. Please try again');
        }

        return back();
    }
}
