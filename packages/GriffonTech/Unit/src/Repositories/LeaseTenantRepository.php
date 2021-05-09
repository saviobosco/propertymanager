<?php


namespace GriffonTech\Unit\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Unit\Contracts\LeaseTenant;

class LeaseTenantRepository extends Repository
{

    public function model()
    {
        return LeaseTenant::class;
    }
}
