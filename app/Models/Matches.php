<?php

// Matches.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'tournament_id',
        'team1_id',
        'team2_id',
        'status',
        'result',
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function team1()
    {
        return $this->belongsTo(Teammanager::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Teammanager::class, 'team2_id');
    }
}