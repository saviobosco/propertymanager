<?php


namespace GriffonTech\Unit\Models;

use GriffonTech\Property\Models\PropertyProxy;
use GriffonTech\Unit\Contracts\Lease as LeaseContract;
use Illuminate\Database\Eloquent\Model;

class Lease extends Model implements LeaseContract
{

    protected $table = 'leases';

    protected $fillable = [
        'unit_id',
        'property_id',
        'lease_type',
        'start_date',
        'end_date',
        'rent_cycle',
        'signature_status',
        'security_deposit_amount',
        'security_deposit_due_date'
    ];

    public function property()
    {
        return $this->belongsTo(PropertyProxy::modelClass(), 'property_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(UnitProxy::modelClass(), 'unit_id', 'id');
    }

    public function rents()
    {
        return $this->hasMany(LeaseRentProxy::modelClass(), 'lease_id', 'id');
    }

    public function charges()
    {
        return $this->hasMany(LeaseChargeProxy::modelClass(), 'lease_id', 'id');
    }


    public function tenants()
    {
        return $this->hasMany(LeaseTenantProxy::modelClass(), 'lease_id', 'id');
    }
}
