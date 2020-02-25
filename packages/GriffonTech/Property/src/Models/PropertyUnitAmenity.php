<?php


namespace GriffonTech\Property\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Property\Contracts\PropertyUnitAmenity as PropertyUnitAmenityContract;
class PropertyUnitAmenity extends Model implements PropertyUnitAmenityContract
{
    protected $table = 'property_unit_amenities';

    protected $fillable = ['property_unit_type_id', 'amenity_id'];

    public $timestamps = false;

}
