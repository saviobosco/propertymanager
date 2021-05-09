<?php


namespace GriffonTech\Property\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Property\Contracts\PropertyOwner;

class PropertyOwnerRepository extends Repository
{

    public function model()
    {
        return PropertyOwner::class;
    }
}
