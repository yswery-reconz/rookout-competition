<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestigationApp extends Model
{

    public function debug_events()
    {
        return $this->hasMany(DebugEvent::class);
    }
}
