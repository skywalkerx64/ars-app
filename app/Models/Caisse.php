<?php

namespace App\Models;

use App\Models\Agence;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Caisse extends Model
{
    
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
    use HasFactory;
}
