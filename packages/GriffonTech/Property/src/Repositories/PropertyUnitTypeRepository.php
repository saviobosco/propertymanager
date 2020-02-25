<?php


namespace GriffonTech\Property\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Property\Contracts\PropertyUnitType;

class PropertyUnitTypeRepository extends Repository
{

    public function model()
    {
        return PropertyUnitType::class;
    }
}
