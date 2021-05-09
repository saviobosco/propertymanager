<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Core\Models\TaskCategory;
use GriffonTech\Core\Repositories\TaskCategoryRepository;
use Illuminate\Http\Request;

class TaskCategoriesController extends Controller
{

    protected $_config;
    protected $taskCategoryRepository;

    public function __construct(
        TaskCategoryRepository $taskCategoryRepository
    )
    {
        $this->taskCategoryRepository = $taskCategoryRepository;
        $this->_config = request('_config');
    }

    public function index()
    {
        $taskCategories = $this->taskCategoryRepository->all();
        return view($this->_config['view'])
            ->with(compact('taskCategories'));
    }

    public function create()
    {
        return view($this->_config['view']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $postData = $request->input();
        $postData['type'] = 'user_defined';
        $postData['company_id'] = auth()->user()->company_id;

        $taskCategory = $this->taskCategoryRepository->create($postData);
        if ($taskCategory) {
            session()->flash('success', 'New task category was successfully added');
        } else {
            session()->flash('error', 'Task category could not be added.');
        }
        return redirect()->route($this->_config['redirect']);
    }


    public function edit(TaskCategory $taskCategory)
    {
        return view($this->_config['view'])
            ->with(compact('taskCategory'));
    }


    public function update(Request $request, TaskCategory $taskCategory)
    {

    }

    public function destroy(TaskCategory $taskCategory)
    {
        if ($taskCategory->type !== 'user_defined') {
            session()->flash('error', 'You can only delete user defined categories.');
            return back();
        }
        try {
            $taskCategory->delete();
            // move all tasks in the category to uncategorized.
            session()->flash('success', 'Category was successfully deleted.');
        } catch (\Exception $exception) {
            session()->flash('error', 'An error occurred delete this category.');
        }
        return back();
    }

}
