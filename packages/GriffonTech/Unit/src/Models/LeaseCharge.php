<?php


namespace GriffonTech\Unit\Models;

use GriffonTech\Unit\Contracts\LeaseCharge as LeaseChargeContract;
use Illuminate\Database\Eloquent\Model;

class LeaseCharge extends Model implements LeaseChargeContract
{
    protected $table = 'lease_charges';

    protected $fillable = [
        'lease_id',
        'frequency',
        'amount',
        'account_id',
        'next_due_date',
        'memo'
    ];
}
