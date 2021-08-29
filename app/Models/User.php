<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PhpParser\Node\Expr\FuncCall;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public function getLevel(){
        return $this->belongsTo('App\Models\Level','level_id');
    }
    public function getPin(){
        return $this->hasOne('App\Models\Pincode','user_id');
    }
    public function getTask(){
        return $this->belongsToMany('App\Models\Task')->withTimestamps();
    }
    public function getUsersonSubmitted(){
        return $this->hasMany('App\Models\SubmitTask','user_id');
    }
    public function getUsersonWithdraw(){
        return $this->hasMany('App\Models\Withdraw','user_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
