<?php


namespace GriffonTech\Unit\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Unit\Contracts\LeaseCharge;

class LeaseChargeRepository extends Repository
{
    public function model()
    {
        return LeaseCharge::class;
    }

}
