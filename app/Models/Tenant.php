<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Workorders()
    {
        return $this->hasMany(Workorder::class);
    }

    public function Properties()
    {
        return $this->hasMany(Property::class);
    }

    public function Malfunctions()
    {
        return $this->hasMany(Malfunction::class);
    }
}
