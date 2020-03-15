<?php


namespace GriffonTech\Core\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Core\Contracts\LeaseExpiredSmsReminder as LeaseExpiredSmsReminderContract;

class LeaseExpiredSmsReminder extends Model implements LeaseExpiredSmsReminderContract
{
    protected $table = 'lease_expired_sms_reminder';

    protected $fillable = ['unit_id', 'property_id',
        'tenant_id', 'phone_number', 'message', 'lease_ends'];

}
