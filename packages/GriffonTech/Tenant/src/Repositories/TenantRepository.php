<?php


namespace GriffonTech\Tenant\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Tenant\Contracts\Tenant;

class TenantRepository extends Repository
{

    public function model()
    {
        return Tenant::class;
    }
}
