<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    public $timestamps = false;
    protected $table = 'poll';

    public function answers() {
        return $this->hasMany('App\PollAnswers');
    }
}
