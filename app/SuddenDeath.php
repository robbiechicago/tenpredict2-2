<?php

namespace App;

use App\Season;
use Illuminate\Database\Eloquent\Model;

class SuddenDeath extends Model
{
    protected $table = 'sudden_death';
    public $timestamps = false;

    public function picks() {
        return $this->hasMany('App\SuddenDeathPicks');
    }

    public function is_first_week($current_week) {
        if ($current_week == $this->start_week_id) {
            return 1;
        }
        return 0;
    }

    public function this_seasons_rounds() {
        $current_season = Season::current_season();
        return $this->belongsTo('App\Week')->where('week.season', $current_season)
    }
}
