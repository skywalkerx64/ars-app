<?php

namespace App\Imports;

use App\Models\Agent;
use App\Models\Carte;
use App\Models\Caisse;
use App\Models\Client;
use App\Models\Paiement;
use App\Models\Transaction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Controllers\Paiement_controller;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PaiementImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collections)
    {
        
        foreach ($collections as $collection) 
        {
        $user=Auth::user();
        $agence=$user->agence;
        $caisses=$agence->caisses;
        $carte=Carte::where('tag',$collection['carte_id'])->first();
        Paiement_controller::pay($carte, $collection['montant']);
    }
}
}
