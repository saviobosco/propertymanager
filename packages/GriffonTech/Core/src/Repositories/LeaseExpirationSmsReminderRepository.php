<?php


namespace GriffonTech\Core\Repositories;


use GriffonTech\Core\Contracts\LeaseExpirationSmsReminder;
use GriffonTech\Core\Eloquent\Repository;

class LeaseExpirationSmsReminderRepository extends Repository
{

    public function model()
    {
        return LeaseExpirationSmsReminder::class;
    }
}
