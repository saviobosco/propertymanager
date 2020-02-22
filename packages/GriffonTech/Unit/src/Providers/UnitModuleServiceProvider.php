<?php

namespace GriffonTech\Unit\Providers;

use GriffonTech\Unit\Models\Unit;
use Konekt\Concord\BaseModuleServiceProvider;

class UnitModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $models = [
        Unit::class
    ];
}
