<?php


namespace GriffonTech\Unit\Models;


use GriffonTech\Property\Models\PropertyProxy;
use GriffonTech\Property\Models\PropertyUnitTypeProxy;
use GriffonTech\Tenant\Models\TenantProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Unit\Contracts\Unit as UnitContract;

class Unit extends Model implements UnitContract
{

    protected $fillable = [
        'property_id',
        'identifier',
        'market_rent',
        'size',
        'address_line1',
        'address_line2',
        'address_line3',
        'city',
        'state',
        'country',
        'zip_code',
        'room',
        'bath_room',
        'description',
        'features',
    ];


    public function property()
    {
        return $this->belongsTo(PropertyProxy::modelClass(), 'property_id', 'id');
    }

    public function tenants()
    {
        return $this->hasMany(TenantProxy::modelClass(), 'unit_id', 'id');
    }

    public function property_unit_type()
    {
        return $this->belongsTo(PropertyUnitTypeProxy::modelClass(), 'property_unit_type_id', 'id');
    }

    public function rent_payments()
    {
        return $this->hasMany(UnitRentPaymentProxy::modelClass(), 'unit_id', 'id');
    }


    public function updateLease($start_date, $end_date)
    {
        $this->forceFill([
            'lease_starts' => $start_date,
            'lease_ends' => $end_date
        ]);
        return $this->update();
    }
}
