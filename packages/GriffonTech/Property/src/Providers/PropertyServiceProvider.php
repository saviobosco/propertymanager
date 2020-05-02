<?php

namespace GriffonTech\Property\Providers;

use Illuminate\Support\ServiceProvider;

class PropertyServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }


    public function register()
    {
        $this->registerConfig();
    }

    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/property_types.php', 'property_types'
        );
    }
}
