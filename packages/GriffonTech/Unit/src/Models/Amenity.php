<?php


namespace GriffonTech\Unit\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Unit\Contracts\Amenity as AmenityContract;

class Amenity extends Model implements AmenityContract
{

    protected $table = 'amenities';

    protected $fillable = ['type'];

    public $timestamps = false;
}
