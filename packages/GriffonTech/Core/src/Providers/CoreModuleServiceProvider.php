<?php


namespace GriffonTech\Core\Providers;


use GriffonTech\Core\Models\LeaseExpirationSmsReminder;
use GriffonTech\Core\Models\LeaseExpiredSmsReminder;
use Konekt\Concord\BaseModuleServiceProvider;

class CoreModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $models = [
        LeaseExpirationSmsReminder::class,
        LeaseExpiredSmsReminder::class
    ];
}
