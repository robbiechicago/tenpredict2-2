<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollVotes extends Model
{
    protected $table = 'poll_votes';
    public $timestamps = false;

    public function answer() {
        return $this->belongsTo('App\PollAnswers');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

}
