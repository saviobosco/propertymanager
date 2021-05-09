<?php


namespace GriffonTech\Property\Models;


class PropertyType
{
    protected $attributes = [];
    protected $id;

    public function __construct(array $data = [])
    {
        $this->attributes = $data;
        $this->id = $data['id'];
    }

    public function __get($name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }
        return null;
    }

    public function __toString()
    {
        return (string) $this->id;
    }
}
