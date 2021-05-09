<?php


namespace GriffonTech\Core\Providers;


use GriffonTech\Core\Models\Company;
use GriffonTech\Core\Models\LeaseExpirationSmsReminder;
use GriffonTech\Core\Models\LeaseExpiredSmsReminder;
use GriffonTech\Core\Models\Task;
use GriffonTech\Core\Models\TaskCategory;
use Konekt\Concord\BaseModuleServiceProvider;

class CoreModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $models = [
        LeaseExpirationSmsReminder::class,
        LeaseExpiredSmsReminder::class,
        Company::class,
        Task::class,
        TaskCategory::class
    ];
}
