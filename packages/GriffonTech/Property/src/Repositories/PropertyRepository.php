<?php


namespace GriffonTech\Property\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Property\Contracts\Property;

class PropertyRepository extends Repository
{

    CONST PROPERTY_TYPES = [
        '' => '--Select Property Type',
        'house' => 'House',
        'apartment' => 'Single Apartment',
        'apartments_complex' => 'Apartment Complex',
        'lock_up_store' => 'Lock Up Stores',
        'warehouse' => 'WareHouse',
    ];

    public function model()
    {
        return Property::class;
    }

    public function getPropertyTypes()
    {
        return static::PROPERTY_TYPES;
    }

}
