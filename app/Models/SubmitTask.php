<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmitTask extends Model
{
    use HasFactory;
    public function getSubmitedUser(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function getSubmitedTask(){
        return $this->belongsTo('App\Models\task','task_id');
    }
}
