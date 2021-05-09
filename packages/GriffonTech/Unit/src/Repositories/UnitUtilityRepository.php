<?php


namespace GriffonTech\Unit\Repositories;


class UnitUtilityRepository
{

    public function getBathRooms()
    {
        return [
            ''=> '',
            '1'=>'1 Bath',
            '1.5' => '1.5 Bath',
            '2' => '2 Bath',
            '2.5' => '2.5 Bath',
            '3' => '3 Bath',
            '3.5' => '3.5 Bath',
            '4' => '4 Bath',
            '4.5' => '4.5 Bath',
            '5' => '5 Bath',
            '5+' => '5+ Bath',
        ];
    }

    public function getRooms()
    {
        return [
            '' => '',
            '1' => '1 bed',
            '2' => '2 bed',
            '3' => '3 bed',
            '4' => '4 bed',
            '5' => '5 bed',
            '6' => '6 bed',
            '7' => '7 bed',
            '8' => '8 bed',
            '9' => '9 bed',
            '9+' => '9+ bed',
            'studio' => 'studio',
        ];
    }
}
