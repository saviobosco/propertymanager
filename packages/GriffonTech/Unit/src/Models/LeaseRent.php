<?php


namespace GriffonTech\Unit\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Unit\Contracts\LeaseRent as LeaseRentContract;
class LeaseRent extends Model implements LeaseRentContract
{
    protected $table = 'lease_rents';

    protected $fillable = [
        'lease_id',
        'amount',
        'start_date',
        'end_date',
        'next_due_date',
        'memo',
    ];
}
