<?php


namespace GriffonTech\Unit\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Unit\Contracts\LeaseRent;

class LeaseRentRepository extends Repository
{

    public function model()
    {
        return LeaseRent::class;
    }
}
