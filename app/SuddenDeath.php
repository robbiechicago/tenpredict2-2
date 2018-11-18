<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuddenDeath extends Model
{
    protected $table = 'sudden_death';
    public $timestamps = false;

    public function picks() {
        return $this->hasMany('App\SuddenDeathPicks');
    }
}
