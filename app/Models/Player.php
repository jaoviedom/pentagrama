<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    protected $fillable = [
        'user_id',
        'nickname',
        'avatar',
        'color',
        'pin',
        'last_access_at',
    ];

    protected $casts = [
        'last_access_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(Progress::class);
    }

    /**
     * Recompensas ganadas por el jugador
     */
    public function rewards(): BelongsToMany
    {
        return $this->belongsToMany(Reward::class, 'player_rewards')
                    ->withPivot('earned_at');
    }
}
