<?php


namespace GriffonTech\Property\Providers;

use GriffonTech\Property\Models\Property;
use GriffonTech\Property\Models\PropertyOwner;
use GriffonTech\Property\Models\PropertyUnitAmenity;
use GriffonTech\Property\Models\PropertyUnitType;
use GriffonTech\Property\Models\RentalOwnerProperty;
use Konekt\Concord\BaseModuleServiceProvider;

class PropertyModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $models = [
        Property::class,
        PropertyUnitType::class,
        PropertyUnitAmenity::class,
        PropertyOwner::class,
        RentalOwnerProperty::class
    ];
}
