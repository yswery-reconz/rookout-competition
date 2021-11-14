<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getTimeTakenAttribute()
    {
        $timeTaken = Carbon::now()
            ->addSecond($this->stop_time - $this->start_time)
            ->diffForHumans($other = null, $syntax = null, $short = false, $parts = 3);

        return trim(str_replace('from now', '', $timeTaken));
    }

    public function debug_events()
    {
        return $this->belongsToMany(DebugEvent::class)->withPivot('function_data');
    }
}
