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
        return $this->belongsTo(User::class);
    }

    public function MalfunctionsHandling()
    {
        return $this->belongsTo(MalfunctionHandling::class);
    }

    public function Tenants()
    {
        return $this->belongsTo(Tenant::class);
    }
}
