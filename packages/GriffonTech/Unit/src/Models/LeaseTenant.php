<?php


namespace GriffonTech\Unit\Models;


use GriffonTech\Tenant\Models\TenantProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Unit\Contracts\LeaseTenant as LeaseTenantContract;
class LeaseTenant extends Model implements LeaseTenantContract
{

    protected $table = 'lease_tenants';

    protected $fillable = [
        'lease_id',
        'tenant_id'
    ];

    public function lease()
    {
        return $this->belongsTo(LeaseProxy::modelClass(), 'lease_id', 'id');
    }

    public function tenant()
    {
        return $this->belongsTo(TenantProxy::modelClass(), 'tenant_id', 'id');
    }

}
