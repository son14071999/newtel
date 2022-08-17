<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oauth_client extends Model
{
    protected $table = 'oauth_clients';
    use HasFactory;
    protected $guarded = [];
}
