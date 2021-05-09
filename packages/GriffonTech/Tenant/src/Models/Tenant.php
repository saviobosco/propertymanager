<?php


namespace GriffonTech\Tenant\Models;


use GriffonTech\Property\Models\PropertyProxy;
use GriffonTech\Unit\Models\LeaseTenant;
use GriffonTech\Unit\Models\LeaseTenantProxy;
use GriffonTech\Unit\Models\UnitProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Tenant\Contracts\Tenant as TenantContract;

class Tenant extends Model implements TenantContract
{

    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'primary_email_address',
        'alternate_email_address',
        'mobile_phone_number',
        'work_phone_number',
        'home_phone_number',
        'fax_phone_number',
        'date_of_birth',
        'comment',
        'profile_photo',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_phone_number',
        'emergency_contact_email_address',
        'company_id'
    ];

    public function leases()
    {
        return $this->hasMany(LeaseTenantProxy::modelClass(), 'tenant_id', 'id');
    }


    public function getFullNameAttribute()
    {
        return $this->first_name .' '
            .$this->last_name;
    }


}
