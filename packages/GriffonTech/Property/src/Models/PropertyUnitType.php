<?php


namespace GriffonTech\Property\Models;


use GriffonTech\Unit\Models\UnitTypeProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Property\Contracts\PropertyUnitType as PropertyUnitTypeContract;

class PropertyUnitType extends Model implements PropertyUnitTypeContract
{

    protected $table = 'property_unit_types';

    protected $fillable = ['property_id', 'unit_type_id', 'amount'];

    public function unit_type()
    {
        return $this->belongsTo(UnitTypeProxy::modelClass(), 'unit_type_id', 'id');
    }

    public function unit_amenities()
    {
        return $this->belongsToMany(PropertyUnitAmenityProxy::modelClass(), 'property_unit_amenities', 'property_unit_type_id', 'amenity_id');
    }
}
