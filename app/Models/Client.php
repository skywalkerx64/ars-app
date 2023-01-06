<?php

namespace App\Models;

use App\Models\Agent;
use App\Models\Carte;
use App\Models\Agence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }

    public function cartes()
    {
        return $this->hasMany(Carte::class);
    }
    use HasFactory;
}
