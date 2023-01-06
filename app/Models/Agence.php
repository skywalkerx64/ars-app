<?php

namespace App\Models;

use App\Models\User;
use App\Models\Agent;
use App\Models\Caisse;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agence extends Model
{
    use HasFactory;
    public function agents()
    {
        return $this->hasMany(Agent::class);
    }
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
    public function caisses()
    {
        return $this->hasMany(Caisse::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
