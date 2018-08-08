<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class forum extends Model
{
    protected $table = 'forum';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User');
    }
}
