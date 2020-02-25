<?php


namespace GriffonTech\Unit\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Unit\Contracts\UnitType;

class UnitTypeRepository extends Repository
{

    public function model()
    {
        return UnitType::class;
    }
}
