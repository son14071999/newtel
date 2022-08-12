<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_permit extends Model
{
    protected $table = "role_permit";
    protected $guarded = [];

    use HasFactory;
}
