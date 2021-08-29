<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function getTaskUser(){
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }
    public function getSubmitedTask(){
        return $this->belongsToMany('App\Modes\SubmitTask')->withTimestamps();
    }
    public function getAllSubmittedTask(){
        return $this->hasMany('App\Models\Task','task_id');
    }
}
