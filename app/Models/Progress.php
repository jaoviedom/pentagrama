<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progress';

    protected $fillable = [
        'player_id',
        'world',
        'level',
        'stars',
        'is_completed',
        'best_score',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
