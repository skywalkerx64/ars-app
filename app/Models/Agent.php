<?php

namespace App\Models;

use App\Models\Agence;
use App\Models\Client;
use App\Models\Paiement;
use App\Models\Ventes_agent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    protected $fillable=['nom','prenom','age','sexe','contact','urgence_contact','diplome','adresse','diplome','agence_id'];
    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
    public function ventes_agent()
    {
        return $this->hasOne(Ventes_agent::class);
    }
    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
