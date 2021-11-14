<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DebugEvent extends Model
{
    public function investigation_app()
    {
        return $this->belongsTo(InvestigationApp::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('function_data');
    }
}
