<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'tenants';

    protected $fillable = ['property_id', 'first_name', 'last_name', 'phone_number', 'lease_starts', 'lease_ends'];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
}
