<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Malfunction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function MalfunctionsHandling()
    {
        return $this->hasMany(MalfunctionHandling::class);
    }

    public function Tenants()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function Status()
    {
        return $this->belongsTo(Status::class);
    }
}
