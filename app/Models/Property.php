<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Status()
    {
        return $this->belongsTo(Status::class);
    }

    public function Tenants()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
