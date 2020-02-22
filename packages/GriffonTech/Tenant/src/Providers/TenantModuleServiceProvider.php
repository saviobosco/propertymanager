<?php


namespace GriffonTech\Tenant\Providers;

use GriffonTech\Tenant\Models\Tenant;
use Konekt\Concord\BaseModuleServiceProvider;


class TenantModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $models = [
        Tenant::class
    ];
}
