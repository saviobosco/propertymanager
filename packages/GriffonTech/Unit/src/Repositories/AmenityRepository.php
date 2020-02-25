<?php


namespace GriffonTech\Unit\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Unit\Contracts\Amenity;

class AmenityRepository extends Repository
{

    public function model()
    {
        return Amenity::class;
    }

}
