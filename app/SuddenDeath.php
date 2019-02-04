<?php

namespace App;

use App\Season;
use App\SuddenDeathPicks;
use App\Week;
use Illuminate\Database\Eloquent\Model;

class SuddenDeath extends Model
{
    protected $table = 'sudden_death';
    public $timestamps = false;

    public function picks() {
        return $this->hasMany('App\SuddenDeathPicks');
    }

    public function picksByUserWeek() {
        return $this->hasMany('App\SuddenDeathPicks')->orderBy('user_id', 'ASC')->orderBy('week_id', 'ASC');
    }

    public function is_first_week($current_week) {
        if ($current_week == $this->start_week_id) {
            return 1;
        }
        return 0;
    }

    public function get_deadline() {
        return 'chonk';
    }

    public function num_weeks($current_week) {
        return Week::where('id', '>=' , $this->start_week_id)->where('id', '<=', $current_week)->whereNotNull('play_week_num')->count();
    }

    public function this_seasons_rounds() {
        $current_season = Season::current_season();
        return $this->belongsTo('App\Week')->where('week.season', $current_season);
    }

    public function my_current_sd($user_id) {
        $week = new Week;
        $current_week = $week->current_week()->id;
        $sd = $this->orderBy('start_week_id', 'DESC')->first();
        $picks = SuddenDeathPicks::where('sudden_death_id', $sd->id)->where('user_id', $user_id)->get();
        return $picks;
    }



}
