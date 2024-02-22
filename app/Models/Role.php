<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN    = 1;
    const HELPDESK = 2;
    const MONTEUR  = 3;

    use HasFactory;
}
