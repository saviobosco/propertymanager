<?php


namespace GriffonTech\Property\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Property\Contracts\PropertyOwner as PropertyOwnerContract;

class PropertyOwner extends Model implements PropertyOwnerContract
{
    protected $table = 'property_owners';


    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'date_of_birth',
        'primary_email_address',
        'alternate_email_address',
        'mobile_phone_number',
        'home_phone_number',
        'work_phone_number',
        'fax_phone_number',
        'address_line1',
        'address_line2',
        'address_line3',
        'city',
        'state',
        'zip_code',
        'country',
        'comment',
        'agreement_start_date',
        'agreement_end_date',
        'company_id'
    ];

    protected $casts = [
        'agreement_start_date' => 'date',
        'agreement_end_date' => 'date'
    ];


    public function getAddressAttribute()
    {
        return $this->address_line1 .' ' .
            $this->address_line2.' '.
            $this->address_line3;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function properties()
    {
        return $this->hasMany(RentalOwnerPropertyProxy::modelClass(), 'property_owner_id', 'id');
    }

}
