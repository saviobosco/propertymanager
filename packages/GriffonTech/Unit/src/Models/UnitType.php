<?php


namespace GriffonTech\Unit\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Unit\Contracts\UnitType as UnitTypeContract;

class UnitType extends Model implements UnitTypeContract
{

    protected $table = 'unit_types';

    protected $fillable = ['type'];

    public $timestamps = false;

}
