<?php


namespace GriffonTech\Tenant\Models;


use GriffonTech\Property\Models\PropertyProxy;
use GriffonTech\Unit\Models\UnitProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Tenant\Contracts\Tenant as TenantContract;

class Tenant extends Model implements TenantContract
{

    protected $fillable = [
        'property_id', 'unit_id', 'first_name', 'last_name', 'middle_name',
        'occupation', 'phone_number', 'email_address', 'state_of_origin', 'l_g_a',
        'hometown', 'lease_starts', 'lease_ends', 'photo', 'was_evicted', 'reason_for_eviction',
        'note', 'active'
    ];

    public function property()
    {
        return $this->belongsTo(PropertyProxy::modelClass(), 'property_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(UnitProxy::modelClass(), 'unit_id', 'id');
    }

}
