<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}
