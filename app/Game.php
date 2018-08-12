<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $dates = ['created_at', 'updated_at', 'kickoff_datetime'];

    public function week() {
        return $this->belongsTo(Week::class);
    }

    public function predictions() {
        return $this->hasMany(Prediction::class, 'game_id');
    }
}
