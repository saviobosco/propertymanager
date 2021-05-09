<?php


namespace GriffonTech\Property\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Property\Contracts\RentalOwnerProperty;

class RentalOwnerPropertyRepository extends Repository
{

    public function model()
    {
        return RentalOwnerProperty::class;
    }
}
