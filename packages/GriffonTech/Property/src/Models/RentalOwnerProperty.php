<?php


namespace GriffonTech\Property\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Property\Contracts\RentalOwnerProperty as RentalOwnerPropertyContract;

class RentalOwnerProperty extends Model implements RentalOwnerPropertyContract
{

    protected $table = 'property_owners_properties';

    protected $fillable = [
        'property_owner_id',
        'property_id',
        'ownership_percentage'
    ];

    public function property()
    {
        return $this->belongsTo(PropertyProxy::modelClass(), 'property_id', 'id');
    }


    public function owner()
    {
        return $this->belongsTo(PropertyOwnerProxy::modelClass(), 'property_owner_id', 'id');
    }
}
