<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vente extends Model
{
    use softdeletes;
    protected $fillable=['cout'];
    public function carte()
    {
        return $this->belongsTo(Carte::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    use HasFactory;
}
