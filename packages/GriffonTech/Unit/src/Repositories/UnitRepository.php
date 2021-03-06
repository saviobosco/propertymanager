<?php


namespace GriffonTech\Unit\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Unit\Contracts\Unit;

class UnitRepository extends Repository
{

    CONST OCCUPIED = 1;

    public function model()
    {
        return Unit::class;
    }
}
