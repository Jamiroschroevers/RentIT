<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workorder extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function MalfunctionsHandling()
    {
        return $this->belongsTo(MalfunctionHandling::class, 'MH_id');
    }

    public function Tenants()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
