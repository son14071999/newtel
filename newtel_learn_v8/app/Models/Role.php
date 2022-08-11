<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permit;

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


    public function scopeGetCodePermits($query, $id){
        $role = Role::find($id);
        $permits = $role->permissions->toArray(); 
        return array_map(function($permit){
            return $permit['code'];
        }, $permits);
    }
}
