<?php


namespace GriffonTech\Property\Models;


use GriffonTech\Unit\Models\UnitProxy;
use GriffonTech\Tenant\Models\TenantProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Property\Contracts\Property as PropertyContract;
class Property extends Model implements PropertyContract
{

    protected $fillable = [
        'user_id', 'name', 'address', 'city', 'state', 'country', 'landlord_name',
        'landlord_address', 'landlord_bank_account_details', 'property_type'
    ];

    public function units()
    {
        return $this->hasMany(UnitProxy::modelClass(), 'property_id', 'id');
    }

    public function tenants()
    {
        return $this->hasMany(TenantProxy::modelClass(), 'property_id', 'id');
    }
}
