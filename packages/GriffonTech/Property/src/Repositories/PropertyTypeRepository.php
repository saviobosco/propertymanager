<?php


namespace GriffonTech\Property\Repositories;


class PropertyTypeRepository
{
    protected $property_types ;

    public function __construct()
    {
        $property_types = config()->get('property_types');
        $collection = collect($property_types);

        $this->property_types = $collection;
    }

    /**
     * This return a laravel collection of
     * property types grouped by their category
     */
    public function getTypesGroupedByCategory()
    {
        return $this->property_types
            ->sortBy('sort')
            ->groupBy('category');
    }
}
