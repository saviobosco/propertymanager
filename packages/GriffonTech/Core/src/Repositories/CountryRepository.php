<?php


namespace GriffonTech\Core\Repositories;


use PragmaRX\Countries\Package\Countries;

class CountryRepository
{

    public function listArray(): array
    {
        $countries =  Countries::all()
            ->sortBy('name.common')
            ->pluck('name.common', 'cca3')
            ->toArray();

        $countries = ['' => ''] + $countries;
        return $countries;
    }

    public function getStatesJson()
    {
        return
        Countries::all()
            ->map(function($value) {
                return $value->hydrateStates()->states->pluck('extra.name_en', 'postal');
            })->toJson();
    }
}
