<?php


namespace GriffonTech\Property\Providers;

use GriffonTech\Property\Models\Property;
use Konekt\Concord\BaseModuleServiceProvider;

class PropertyModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $models = [
        Property::class,
    ];
}
