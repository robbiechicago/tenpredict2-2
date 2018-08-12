<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    public function game() {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
