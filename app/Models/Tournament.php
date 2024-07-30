<?php

namespace App\Models;

use App\Models\Teammanager;
use App\Models\Tournament_team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'location',
        'type',
        'format',
        'organiser_id',
    ];


    public function team()
{
    return $this->hasMany(Tournament_team::class);
}

public function matches()
{
    return $this->hasMany(Matches::class);
}

public function teamManagers()
{
    return $this->belongsToMany(Teammanager::class, 'tournament_teams', 'tournament_id', 'teammanager_id');
}



}
