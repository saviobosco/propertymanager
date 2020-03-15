<?php


namespace GriffonTech\Unit\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Unit\Contracts\UnitExpense;

class UnitExpenseRepository extends Repository
{

    public function model()
    {
        return UnitExpense::class;
    }

}
