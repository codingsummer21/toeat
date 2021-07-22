<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Toit extends Model
{
    use HasFactory;

    function user() {
        return $this->belongsTo(User::class);
    }

    public function reportedBy() {
        return $this->belongsToMany('App\Models\User', 'user_reports_toits')
            ->withPivot('violation')
            ->withPivot('accepted')
            ->withTimestamps();
    }
}
