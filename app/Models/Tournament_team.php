<?php

namespace App\Models;

use App\Models\Tournament;
use App\Models\Teammanager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Tournament_team extends Model
{
    use HasFactory;

    protected $fillable = [
        'teammanager_id',
        'tournament_id',
        'standings',
        'points',

    ];

    public function teammanager() {
        return $this->belongsTo(Teammanager::class , 'teammanager_id' );
    }

    public function tournaments() {
        return $this->belongsTo(Tournament::class , 'tournament_id' );
    }

    public function tour_team()
    {
        return $this->hasMany(Tournament_team::class);
    }
}

