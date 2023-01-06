<?php

namespace App\Models;

use App\Models\Carte;
use App\Models\Agent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    protected $fillable=['agent_id', 'client_id', 'carte_id', 'montant'];
    use HasFactory;
    public function carte()
    {
        return $this->belongsTo(Carte::class);
    }
        public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
    use HasFactory;
}
