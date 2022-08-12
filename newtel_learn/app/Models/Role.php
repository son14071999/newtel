<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
    ];
    public function permissions()
    {
        return $this->belongsToMany(Permit::class,'role_permit','role_id','permit_id');
    }
}
