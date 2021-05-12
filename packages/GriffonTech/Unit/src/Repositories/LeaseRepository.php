<?php


namespace GriffonTech\Unit\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Unit\Contracts\Lease;

class LeaseRepository extends Repository
{

    public function model()
    {
        return Lease::class;
    }

    public function getStatusTypes()
    {
        return \GriffonTech\Unit\Models\Lease::$statuses;
    }
}
