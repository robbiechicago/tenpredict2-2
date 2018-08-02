<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    public function season() {
        return $this->belongsTo(Season::class);
    }

    public function games() {
        return $this->hasMany(Game::class);
    }
}
