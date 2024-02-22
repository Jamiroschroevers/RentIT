<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MalfunctionHandling extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function Workorders()
    {
        return $this->hasMany(Workorder::class);
    }

    public function Images()
    {
        return $this->belongsTo(Image::class);
    }

    public function Malfunctions()
    {
        return $this->belongsTo(Malfunction::class);
    }
}
