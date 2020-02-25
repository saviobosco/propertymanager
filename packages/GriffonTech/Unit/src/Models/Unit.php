<?php


namespace GriffonTech\Unit\Models;


use GriffonTech\Property\Models\PropertyProxy;
use GriffonTech\Property\Models\PropertyUnitTypeProxy;
use GriffonTech\Tenant\Models\TenantProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Unit\Contracts\Unit as UnitContract;

class Unit extends Model implements UnitContract
{

    protected $fillable = ['property_id', 'identifier',
        'lease_starts', 'lease_ends', 'is_occupied', 'property_unit_type_id'];


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
}
