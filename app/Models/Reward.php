<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reward extends Model
{
    protected $fillable = ['name', 'description', 'icon', 'type', 'code'];

    /**
     * Jugadores que han ganado esta recompensa
     */
    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'player_rewards')
                    ->withPivot('earned_at');
    }
}
