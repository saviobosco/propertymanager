<?php


namespace GriffonTech\Core\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Core\Contracts\Company as CompanyContract;
class Company extends Model implements CompanyContract
{

    protected $table = 'companies';

    protected $fillable = [
        'name'
    ];
}
