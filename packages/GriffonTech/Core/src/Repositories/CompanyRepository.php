<?php


namespace GriffonTech\Core\Repositories;


use GriffonTech\Core\Contracts\Company;
use GriffonTech\Core\Eloquent\Repository;

class CompanyRepository extends Repository
{

    public function model()
    {
        return Company::class;
    }

}
