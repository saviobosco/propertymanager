<?php


namespace GriffonTech\Unit\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Unit\Contracts\UnitExpense as UnitExpenseContract;

class UnitExpense extends Model implements UnitExpenseContract
{

    protected $table = 'unit_expenses';

    protected $fillable = ['unit_id', 'property_id', 'amount', 'purpose'];

    public function unit()
    {
        return $this->belongsTo(UnitProxy::modelClass(), 'unit_id', 'id');
    }
}
