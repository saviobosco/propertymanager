<?php


namespace GriffonTech\Property\Models;


use GriffonTech\Property\Factories\PropertyTypeFactory;
use GriffonTech\Unit\Models\UnitProxy;
use GriffonTech\Tenant\Models\TenantProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Property\Contracts\Property as PropertyContract;
use PragmaRX\Countries\Package\Countries;

class Property extends Model implements PropertyContract
{

    protected $fillable = [
        'user_id',
        'address_line1',
        'address_line2',
        'address_line3',
        'city',
        'state',
        'zip_code',
        'country',
        'default_operating_account_id',
        'property_type',
        'company_id'
    ];

    public function rental_owners()
    {
        return $this->hasMany(RentalOwnerPropertyProxy::modelClass(), 'property_id', 'id');
    }

    public function units()
    {
        return $this->hasMany(UnitProxy::modelClass(), 'property_id', 'id');
    }

    public function tenants()
    {
        return $this->hasMany(TenantProxy::modelClass(), 'property_id', 'id');
    }




    public function getAttribute($key)
    {
        if ($key === 'country_name') {
            if (!empty($this->attributes['country'])) {
                return Countries::where('cca3', $this->attributes['country'])->first()->name_en;
            }

        } else if ($key === 'state_name') {
            if (!empty($this->attributes['country'])) {
                return Countries::where('cca3', $this->attributes['country'])
                    ->first()->hydrateStates()->states
                    ->where('postal', $this->attributes['state'])
                    ->first()
                    ->name;
            }
        } else if ($key === 'property_type_detail') {
            if (!empty($this->attributes['property_type'])) {
                $property_types = config()->get('property_types');
                return $property_types[$this->attributes['property_type']]['category'] .','
                    . $property_types[$this->attributes['property_type']]['name'];
            }

            return '';

        } else if($key === 'type') {
            return (new PropertyTypeFactory())->get($this->attributes['property_type']);

        } else if ($key === 'type_category') {
            if (!empty($this->attributes['property_type'])) {
                $property_types = config()->get('property_types');
                return $property_types[$this->attributes['property_type']]['category'];
            }
        } else if ($key === 'type_name') {
            if (!empty($this->attributes['property_type'])) {
                $property_types = config()->get('property_types');
                return $property_types[$this->attributes['property_type']]['name'];
            }
        }
        return parent::getAttribute($key);
    }


    public function getAddressAttribute()
    {
        return $this->address_line1 .' ' .
            $this->address_line2.' '.
            $this->address_line3;
    }

}
