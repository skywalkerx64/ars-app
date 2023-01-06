<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Caisse;

class Caisse_controller extends Controller
{
    public function caisses()
    {
        $user=Auth::user();
        $agence=$user->agence;
        $caisses=$agence->caisses;

        $caisse_ca=$caisses->where('tag', 'CA')->first();
        $ca_transactions=$caisse_ca->transactions;

        foreach($ca_transactions as $ca_transaction)
        {
            if($ca_transaction->statut=='Depot')
            {
                $caisse_ca->solde+=$ca_transaction->montant;
            }
            elseif($ca_transaction->statut=='Retrait')
            {
                $caisse_ca->solde-=$ca_transaction->montant; 
            }
            
        }

        $caisse_bf=$caisses->where('tag', 'B')->first();
        $bf_transactions=$caisse_bf->transactions;

        foreach($bf_transactions as $bf_transaction)
        {
            if($bf_transaction->statut=='Depot')
            {
                $caisse_bf->solde+=$bf_transaction->montant;
            }
            elseif($bf_transaction->statut=='Retrait')
            {
                $caisse_bf->solde-=$bf_transaction->montant; 
            }
            
        }

        $caisse_fa=$caisses->where('tag', 'C2')->first();
        $fa_transactions=$caisse_fa->transactions;

        foreach($fa_transactions as $fa_transaction)
        {
            if($fa_transaction->statut=='Depot')
            {
                $caisse_fa->solde+=$fa_transaction->montant;
            }
            elseif($fa_transaction->statut=='Retrait')
            {
                $caisse_fa->solde-=$fa_transaction->montant; 
            }
            
        }

        $caisse_c1=$caisses->where('tag', 'C1')->first();
        $c1_transactions=$caisse_c1->transactions;

        foreach($c1_transactions as $c1_transaction)
        {
            if($c1_transaction->statut=='Depot')
            {
                $caisse_c1->solde+=$c1_transaction->montant;
            }
            elseif($c1_transaction->statut=='Retrait')
            {
                $caisse_c1->solde-=$c1_transaction->montant; 
            }
            
        }

        $caisse_c3=$caisses->where('tag', 'C3')->first();
        $c3_transactions=$caisse_c3->transactions;

        foreach($c3_transactions as $c3_transaction)
        {
            if($c3_transaction->statut=='Depot')
            {
                $caisse_c3->solde+=$c3_transaction->montant;
            }
            elseif($c3_transaction->statut=='Retrait')
            {
                $caisse_c3->solde-=$c3_transaction->montant; 
            }
            
        }
        $caisse_fc=$caisses->where('tag', 'FC')->first();
        $fc_transactions=$caisse_fc->transactions;

        foreach($fc_transactions as $fc_transaction)
        {
            if($fc_transaction->statut=='Depot')
            {
                $caisse_fc->solde+=$fc_transaction->montant;
            }
            elseif($fc_transaction->statut=='Retrait')
            {
                $caisse_fc->solde-=$fc_transaction->montant; 
            }
            
        }
                $caisse_l=$caisses->where('tag', 'L')->first();
        $l_transactions=$caisse_l->transactions;

        foreach($l_transactions as $l_transaction)
        {
            if($l_transaction->statut=='Depot')
            {
                $caisse_l->solde+=$l_transaction->montant;
            }
            elseif($l_transaction->statut=='Retrait')
            {
                $caisse_l->solde-=$l_transaction->montant; 
            }
            
        }

        $caf=$caisse_c3->solde+$caisse_c1->solde+$caisse_fa->solde+$caisse_bf->solde+$caisse_fc->solde-$caisse_l->solde;

        return view('administration.caisses.caisses', compact('user','caisse_ca','caisse_bf','caisse_fa','caisse_c1','caisse_c3','caisse_fc','caisse_l','caf'));
    }

    public function caisse($tag)
    {
        $user=Auth::user();
        $agence=$user->agence;
        $caisses=$agence->caisses;

        $caisse=$caisses->where('tag', $tag)->first();

        $transactions=$caisse->transactions;
        foreach($transactions as $transaction)
        {
            if($transaction!=null)
            {
                if($transaction->statut=='Depot')
                {
                    $caisse->solde+=$transaction->montant;
                }
                elseif($transaction->statut=='Retrait')
                {
                    $caisse->solde-=$transaction->montant; 
                }
            }
           
            
        }

        return view('administration.caisses.caisse', compact('user','caisse','transactions'));
    }

    public function transfert_form($tag)
    {
        $user=Auth::user();
        $agence=$user->agence;
        $caisses=$agence->caisses;

        $caisse=$caisses->where('tag', $tag)->first();

        return view('administration.caisses.transfert_form', compact('user','caisse'));
    }
    public function store(Request $request)
        {
        $user=Auth::user();
        $agence=$user->agence;
        $caisses=$agence->caisses;
        $caisse=$caisses->where('tag', $request->tag)->first();
        $transactions=$caisse->transactions;
        $solde=0;
        foreach($transactions as $transaction)
        {
            if($transaction!=null)
            {
                if($transaction->statut=='Depot')
                {
                    $solde+=$transaction->montant;
                }
                elseif($transaction->statut=='Retrait')
                {
                    $solde-=$transaction->montant; 
                }
            }
           
            
        }
        if($request->montant>$solde && $request->statut=='Retrait')
        {
            $error_message='Solde insuffisant';
            return view('errors.error_page',compact('error_message'));
        }
        else
        {
        $transaction=new Transaction;
        $transaction->montant=$request->montant;
        $transaction->motif=$request->motif;
        $transaction->caisse_id=$caisse->id;
        $transaction->statut=$request->statut;
        $transaction->save();
        return Caisse_controller::caisse($caisse->tag);
        }

    }
    
    public function per_date(Request $request)
    {
        $caisse=Caisse::findorFail($request->caisse_id);
        $transactions=$caisse->transactions->where('created_at', $request->name);
        foreach($transactions as $transaction)
        {
            if($transaction!=null)
            {
                if($transaction->statut=='Depot')
                {
                    $caisse->solde+=$transaction->montant;
                }
                elseif($transaction->statut=='Retrait')
                {
                    $caisse->solde-=$transaction->montant; 
                }
            }
           
            
        }
        $user=Auth::user();

        return view('administration.caisses.caisse', compact('user','caisse','transactions'));
    }
}
