<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class Fiche_controller extends Controller
{
    public function supervision($id)
    {
        $agent=Agent::findorFail($id);
        $clients=$agent->clients->sortBy('adresse');
        $cartes_all=array();
        foreach ($clients as $client)
        {
            
            $cartes=$client->cartes->where('completed', false);
            if(!empty($cartes))
            {
                foreach($cartes as $carte)
                {
                    if($carte->paiements==null)
                    {
                        $paiement_last=null;
                        $paiement_big=null;
                    }
                    $paiement_last=$carte->paiements->last();
                    $paiement_big=$carte->paiements->where('montant','>=',$carte->cout*5)->last();
                    if($paiement_big==null && $paiement_last==null)
                    {
                        $carte->last_big_pay=null;
                        $carte->last_big_pay_date=null;
                        $carte->last_pay=null;
                        $carte->last_pay_date=null;
                    }
                    if($paiement_big==null && $paiement_last!=null)
                    {
                        $carte->last_big_pay=null;
                        $carte->last_big_pay_date=null;
                        $carte->last_pay=$paiement_last->montant;
                        $carte->last_pay_date=$paiement_last->created_at;
                    }
                    elseif($paiement_last==null && $paiement_big!=null)
                    {
                        $carte->last_pay=$paiement_last->montant;
                        $carte->last_pay_date=$paiement_last->created_at;
                        $carte->last_big_pay=null;
                        $carte->last_big_pay_date=null;
                    }
                    elseif($paiement_last!=null && $paiement_big!=null)
                    {
                        $carte->last_pay=$paiement_last->montant;
                        $carte->last_pay_date=$paiement_last->created_at;
                        $carte->last_big_pay=$paiement_big->montant;
                        $carte->last_big_pay_date=$paiement_big->created_at;
                    }
                    
                    array_push($cartes_all, $carte);
                }
            }
            
        }
        $type='supervision';
        return view('fiches.supervision',compact('cartes_all','agent','type'));
    }
    public function terrain($id)
    {
        $agent=Agent::findorFail($id);
        $clients=$agent->clients->sortBy('adresse');
        $cartes_all=array();
        foreach ($clients as $client)
        {
            
            $cartes=$client->cartes->where('completed', false);
            if(!empty($cartes))
            {
                foreach($cartes as $carte)
                {

                    array_push($cartes_all, $carte);
                }
            }
            
        }
        $date=now()->format('d.m.y');
        $type='terrain';
        return view('fiches.terrain', compact('agent','cartes_all','date','type'));
        
    }
    public function controle(Request $request)
    {
        $agent=Agent::findorFail($request->agent_id);
        $clients=$agent->clients->sortBy('adresse');
        $cartes_all=array();
        foreach ($clients as $client)
        {
            
            $cartes=$client->cartes->where('completed', false);
            if(!empty($cartes))
            {
                foreach($cartes as $carte)
                {

                    array_push($cartes_all, $carte);
                }
            }
            
        }
        $date=$request->date;
        $type='controle';
        return view('fiches.controle', compact('agent','cartes_all','date','type'));
    }
    
}
