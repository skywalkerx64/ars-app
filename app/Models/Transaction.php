<?php

namespace App\Models;

use App\Models\Caisse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }
}
