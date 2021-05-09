<?php


namespace GriffonTech\Core\Models;


use GriffonTech\Property\Models\PropertyOwnerProxy;
use GriffonTech\Property\Models\PropertyProxy;
use GriffonTech\Tenant\Models\TenantProxy;
use GriffonTech\Unit\Models\LeaseTenantProxy;
use GriffonTech\Unit\Models\UnitProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Core\Contracts\Task as TaskContract;
class Task extends Model implements TaskContract
{
    protected $table = 'tasks';

    protected $fillable = [
        '*'
    ];

    protected static $unguarded = true;

    public static $types = [
        '1' => 'Resident request',
        '2' => 'Rental owner request',
        '3' => 'To do',
        '4' => 'Contact request'
    ];

    public static $statuses = [
        '1' => 'New',
        '2' => 'In Progress',
        '3' => 'Completed',
        '4' => 'Deferred',
        '5' => 'Closed',
    ];

    public static $priorities = [
        'low' => 'Low',
        'normal' => 'Normal',
        'high' => 'High'
    ];

    public function category()
    {
        return $this->belongsTo(TaskCategoryProxy::modelClass(), 'task_category_id', 'id');
    }

    public function tenant()
    {
        return $this->belongsTo(LeaseTenantProxy::modelClass(),'tenant_id', 'tenant_id');
    }

    public function property()
    {
        return $this->belongsTo(PropertyProxy::modelClass(), 'property_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(UnitProxy::modelClass(), 'unit_id', 'id');
    }

    public function rental_owner()
    {
        return $this->belongsTo(PropertyOwnerProxy::modelClass(), 'rental_owner_id', 'id');
    }


}
