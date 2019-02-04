<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
        return $this->hasMany('App\Forum');
    }

    public function predictions() {
        return $this->hasMany(Prediction::class);
    }

    public function pollvotes() {
        return $this->hasMany('App\PollVotes');
    }

    public function suddenDeathPicks() {
        return $this->hasMany('App\SuddenDeathPicks');
    }
}
