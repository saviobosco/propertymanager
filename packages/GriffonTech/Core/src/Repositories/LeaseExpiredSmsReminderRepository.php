<?php


namespace GriffonTech\Core\Repositories;


use GriffonTech\Core\Contracts\LeaseExpiredSmsReminder;
use GriffonTech\Core\Eloquent\Repository;

class LeaseExpiredSmsReminderRepository extends Repository
{

    public function model()
    {
        return LeaseExpiredSmsReminder::class;
    }


}
