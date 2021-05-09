<?php


namespace GriffonTech\Core\Repositories;


use GriffonTech\Core\Contracts\TaskCategory;
use GriffonTech\Core\Eloquent\Repository;

class TaskCategoryRepository extends Repository
{

    public function model()
    {
        return TaskCategory::class;
    }
}
