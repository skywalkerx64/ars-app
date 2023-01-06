<?php

namespace App\Models;

use App\Models\Vente;
use App\Models\Client;
use App\Models\Paiement;
use App\Models\Transaction;
use App\Models\Carte_evolution;
use App\Models\Notification_livraison;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carte extends Model
{
    use softdeletes;

    public function notification_livraison()
    {
        return $this->hasMany(Notification_livraison::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }
    use HasFactory;
    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
    public function evolution()
    {
        return $this->hasOne(Carte_evolution::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    protected $fillable=['tranches','cout','pourcentage','last_pay','last_big_pay','','LP'];
    
    use HasFactory;
}
