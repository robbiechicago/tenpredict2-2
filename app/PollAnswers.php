<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollAnswers extends Model
{
    protected $table = 'poll_answers';
    public $timestamps = false;

    public function poll() {
        return $this->belongsTo('App\Poll');
    }

    public function votes() {
        return $this->hasMany('App\PollVotes');
    }
}
