<?php


namespace GriffonTech\Core\Providers;


use GriffonTech\Core\Console\Commands\UnitExpirationSmsReminder;
use GriffonTech\Core\Console\Commands\UnitExpiredSmsReminderCommand;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{

    public function boot()
    {
    }

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                UnitExpirationSmsReminder::class,
                UnitExpiredSmsReminderCommand::class
            ]);
        }
    }

}
