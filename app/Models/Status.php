<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Malfunctions()
    {
        return $this->hasMany(Malfunction::class);
    }

    public function Properties()
    {
        return $this->hasMany(Property::class);
    }
}
