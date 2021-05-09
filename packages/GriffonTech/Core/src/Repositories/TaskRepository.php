<?php


namespace GriffonTech\Core\Repositories;


use GriffonTech\Core\Contracts\Task;
use GriffonTech\Core\Eloquent\Repository;

class TaskRepository extends Repository
{

    public function model()
    {
        return Task::class;
    }

    public function getTypes()
    {
        return \GriffonTech\Core\Models\Task::$types;
    }

    public function getStatuses()
    {
        return \GriffonTech\Core\Models\Task::$statuses;
    }

    public function getPriorities()
    {
        return \GriffonTech\Core\Models\Task::$priorities;
    }

}
