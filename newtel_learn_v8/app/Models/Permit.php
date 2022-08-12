<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'display_name',
    ];

    public function childPermit(){
        return $this->hasMany(Permit::class, 'parent_id');
    }


    public function scopeGetCode($query){
        $permits = $query->get()->toArray(); 
        return array_map(function ($permit) {
            return $permit['code'];
        }, $permits);
    }

}
