<?php

namespace App\Models;

use App\Models\Vente;
use App\Models\Ventes_produit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = ['intitule','description', 'prix','prix_2', 'categorie','tag', 'image','pourcentage','pourcentage_2','change_price_count'];
    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }
    public function ventes_produit()
    {
        return $this->hasOne(Ventes_produit::class);
    }
}
