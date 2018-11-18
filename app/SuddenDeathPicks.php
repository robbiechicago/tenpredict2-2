<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuddenDeathPicks extends Model
{
    protected $table = 'sudden_death_picks';
    public $timestamps = false;

    public function sudden_death() {
        return $this->belongsTo('App\SuddenDeath');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
