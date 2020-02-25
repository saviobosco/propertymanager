<?php


namespace GriffonTech\Property\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Property\Contracts\PropertyUnitAmenity;

class PropertyUnitAmenityRepository extends Repository
{

    public function model()
    {
        return PropertyUnitAmenity::class;
    }
}
