<?php

namespace GriffonTech\Unit\Providers;

use GriffonTech\Unit\Models\Amenity;
use GriffonTech\Unit\Models\Unit;
use GriffonTech\Unit\Models\UnitExpense;
use GriffonTech\Unit\Models\UnitRentPayment;
use GriffonTech\Unit\Models\UnitType;
use Konekt\Concord\BaseModuleServiceProvider;

class UnitModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $models = [
        Unit::class,
        UnitType::class,
        Amenity::class,
        UnitRentPayment::class,
        UnitExpense::class
    ];
}
