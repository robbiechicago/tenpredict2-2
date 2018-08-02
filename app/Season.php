<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function weeks() {
        return $this->hasMany(Week::class);
    }
}
