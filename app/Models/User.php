<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Toit;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function toits()
    {
        return $this->hasMany(Toit::class)->orderBy('created_at', 'DESC');
    }

    public function reportedToits()
    {
        return $this->belongsToMany('Toit', 'user_reports_toits')
            ->withPivot('violation')
            ->withPivot('accepted')
            ->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany('App\Models\User', 'user_follows_users', 'user_id', 'following_id')
            ->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany('App\Models\User', 'user_follows_users', 'following_id')
            ->withTimestamps();
    }

    public function feed()
    {
        // return $this->hasManyThrough('App\Models\Toit', 'App\Models\User', 'id');
        $users = $this->following;
        $toits = null;
        foreach ($users as $user) {
            if($toits == null) {
                $toits = $user->toits;
            }
            else {
                $toits = $toits->merge($user->toits);
            }
        }
        return $toits;
    }
}
