<?php


namespace GriffonTech\Core\Models;

use GriffonTech\Core\Contracts\TaskCategory as TaskCategoryContract;
use Illuminate\Database\Eloquent\Model;

class TaskCategory extends Model implements TaskCategoryContract
{
    protected $table = 'task_categories';

    protected $fillable = [
        'name',
        'type',
        'company_id'
    ];


    public function tasks()
    {
        return $this->belongsTo(TaskProxy::modelClass(), 'task_category_id', 'id');
    }
}
