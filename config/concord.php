<?php

return [
    'modules' => [
        /**
         * Example:
         * VendorA\ModuleX\Providers\ModuleServiceProvider::class,
         * VendorB\ModuleY\Providers\ModuleServiceProvider::class
         *
         */
        \GriffonTech\Property\Providers\PropertyModuleServiceProvider::class,
        \GriffonTech\Unit\Providers\UnitModuleServiceProvider::class,
        \GriffonTech\Tenant\Providers\TenantModuleServiceProvider::class,
        \GriffonTech\Core\Providers\CoreModuleServiceProvider::class,
    ]
];
