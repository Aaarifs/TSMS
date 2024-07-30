<?php

namespace App\Models;

use App\Models\Tournament;
use App\Models\Tournament_team;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teammanager extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'teammanager'; // Specify guard

    protected $fillable = [
        'fullname',
        'email',
        'phone_number',
        'password',
        'team_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

        public function tour_team()
    {
        return $this->hasMany(Tournament_team::class);
    }

// public function tournament()
// {
//     return $this->hasMany(Tournament::class);
// }

public function tournaments()
{
    return $this->belongsToMany(Tournament::class, 'tournament_teams', 'teammanager_id', 'tournament_id');
}

// Teammanager.php
public function players()
{
    return $this->hasMany(Player::class, 'teammanager_id');
}




}
