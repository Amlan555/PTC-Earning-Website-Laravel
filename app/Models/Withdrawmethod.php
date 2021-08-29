<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawmethod extends Model
{
    use HasFactory;
    public function getMethodsonWithdraw(){
        return $this->hasMany('App\Models\Withdraw','withdrawmethod_id');
    }
}
