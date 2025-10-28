<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
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


}
