<?php


namespace GriffonTech\Property\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Property\Contracts\Property;

class PropertyRepository extends Repository
{

    public function model()
    {
        return Property::class;
    }
}
