<?php

namespace GriffonTech\Property\Factories;

use \GriffonTech\Property\Models\PropertyType;
use Illuminate\Support\Arr;

class PropertyTypeFactory
{

    protected $types = [];

    public function __construct()
    {
        $this->types = [
            1 => [
                'id' => 1,
                'key' => 'apartment',
                'name' => 'Flats/Apartments',
                'category' => 'Residential',
                'sort' => 1,
            ],
            2 => [
                'id' => 2,
                'key' => 'single_family',
                'name' => 'Single Family',
                'category' => 'Residential',
                'sort' => 2
            ],
            3 => [
                'id' => 3,
                'key' => 'multi_family',
                'name' => 'Multi-Family',
                'category' => 'Residential',
                'sort' => 3
            ],

            // Commercials
            4 => [
                'id' => 4,
                'key' => 'industrial',
                'name' => 'Industrial',
                'category' => 'Commercial',
                'sort' => 4
            ],
            5 => [
                'id' => 5,
                'key' => 'office',
                'name' => 'Office',
                'category' => 'Commercial',
                'sort' => 5
            ],
            6 => [
                'id' => 6,
                'key' => 'retail',
                'name' => 'Retail',
                'category' => 'Commercial',
                'sort' => 6
            ],
            7 => [
                'id' => 7,
                'key' => 'shopping_center',
                'name' => 'Shopping Center',
                'category' => 'Commercial',
                'sort' => 7
            ],
            8 => [
                'id' => 8,
                'key' => 'storage',
                'name' => 'Storage',
                'category' => 'Commercial',
                'sort' => 8
            ],
            9 => [
                'id' => 9,
                'key' => 'parking_space',
                'name' => 'Parking Space',
                'category' => 'Commercial',
                'sort' => 9
            ]
        ];
    }

    public function get($id)
    {
        if (isset($this->types[$id])) {
            return new PropertyType($this->types[$id]);
        }
        return null;
    }
}
