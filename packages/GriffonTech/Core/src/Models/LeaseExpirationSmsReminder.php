<?php


namespace GriffonTech\Core\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Core\Contracts\LeaseExpirationSmsReminder as LeaseExpirationSmsReminderContract;

class LeaseExpirationSmsReminder extends Model implements LeaseExpirationSmsReminderContract
{
    protected $table = 'lease_expiration_sms_reminder';

    protected $fillable = ['unit_id', 'property_id',
        'tenant_id', 'phone_number', 'message', 'lease_ends'];
}
