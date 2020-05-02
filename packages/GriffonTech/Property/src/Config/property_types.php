<?php

return [
    'house' => [
        'key'   => 'house',
        'name'  => 'House',
        'class' => 'GriffonTech\Property\Type\House',
        'sort'  => 1,
    ],
    'apartment' => [
        'key'   => 'apartment',
        'name'  => 'Apartment',
        'class' => 'GriffonTech\Property\Type\Apartment',
        'sort'  => 2,
    ],
    'building' => [
        'key'   => 'building',
        'name'  => 'Building (Apartments)',
        'class' => 'GriffonTech\Property\Type\Building',
        'sort'  => 3,
    ],
    'store' => [
        'key'   => 'stores',
        'name'  => 'Lock Up Stores',
        'class' => 'GriffonTech\Property\Type\Store',
        'sort'  => 4,
    ],
];
