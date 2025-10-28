<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

}
