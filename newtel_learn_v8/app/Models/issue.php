<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Status;

class Issue extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = true;
    protected $appends = ['executor', 'jobAssignor', 'status'];


    public function getExecutorAttribute() {
        return User::find($this->executor_id)->name;
    }

    public function getjobAssignorAttribute() {
        return User::find($this->jobAssignor_id)->name;
    }

    public function getStatusAttribute() {
        return Status::find($this->status_id)->name;
    }
}
