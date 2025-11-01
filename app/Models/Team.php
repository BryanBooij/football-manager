<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'active'
    ];
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'team_user', 'team_id', 'player_id');
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'team_user', 'team_id', 'player_id');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

}
