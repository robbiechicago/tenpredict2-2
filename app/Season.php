<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function weeks() {
        return $this->hasMany(Week::class);
    }

    public function current_season() {
        return $this->where('current', '1')->first();
    }
}
