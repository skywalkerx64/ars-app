<?php

namespace App\Models;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ventes_produit extends Model
{
    use HasFactory;
    protected $fillable=['counts'];
    
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
