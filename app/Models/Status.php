<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const FOR_RENT = 1;
    const IN_USE   = 2;
    const RESERVED = 3;
    const OPEN     = 4;
    const PLANNED  = 5;
    const CLOSED   = 6;

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
