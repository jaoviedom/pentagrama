<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameLog extends Model
{
    protected $fillable = ['player_id', 'world', 'level', 'event_type', 'data'];

    protected $casts = [
        'data' => 'array'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
