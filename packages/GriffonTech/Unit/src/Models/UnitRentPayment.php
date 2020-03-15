<?php


namespace GriffonTech\Unit\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Unit\Contracts\UnitRentPayment as UnitRentPaymentContract;

class UnitRentPayment extends Model implements UnitRentPaymentContract
{
    protected $table = 'unit_rent_payments';

    protected $fillable = ['unit_id', 'property_id', 'amount', 'lease_starts', 'lease_ends', 'note'];

    protected $casts = [
        'lease_starts' => 'date',
        'lease_ends' => 'date'
    ];

}
