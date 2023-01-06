<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Carte;
use App\Models\Vente;
use App\Models\Caisse;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Paiement;
use App\Models\Type_carte;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Carte_evolution;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Client_controller;
use App\Http\Controllers\Paiement_controller;

class Carte_controller extends Controller
{
    public function add_carte($id)
    {
        $types=Type_carte::all();
        $client=Client::findorFail($id);
        $produits_all=Produit::all();
        $produits=array();
        foreach($produits_all as $produit_all)
        {
            array_push($produits,$produit_all->tag);
        }
        $user=Auth::user();
        return view('administration.clients.add_card_form', compact('client','types','user','produits'));
    }

    public function store_carte(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required',
            'produit_1_id'=>'required',
            'client_id'=>'required',
        ]);
        
        $vente1= new Vente;
        $vente2= new Vente;
        $vente3= new Vente;
        $vente4= new Vente;
        $type=Type_carte::where('tag',$request->type)->first();
        $pp=0;
        if( !empty($request->produit_1_id))
        {

            $produit1=Produit::where('tag',$request->produit_1_id)->first();
            $produit1->vente_count++;
            $produit1->save();
            $vente1->produit_id=$produit1->id;
            if($type->duree==558)
            {
                $vente1->cout=$produit1->prix_2/$type->duree;
                $pp1=(($produit1->pourcentage_2*$produit1->prix_2)/100);
            }
            else
            {
                $vente1->cout=$produit1->prix/$type->duree;
                $pp1=(($produit1->pourcentage*$produit1->prix)/100);
            }
            $pp+=$pp1;
            
        }
        if( !empty($request->produit_2_id))
        {
            $produit2=Produit::where('tag',$request->produit_2_id)->first();
            $produit2->vente_count++;
            $produit2->save();
            $vente2->cout=$produit2->prix/$type->duree;
            $vente2->produit_id=$produit2->id;
            if($type->duree==558)
            {
                $vente2->cout=$produit2->prix_2/$type->duree;
                $pp2=(($produit2->pourcentage_2*$produit2->prix_2)/100);
            }
            else
            {
                $vente2->cout=$produit2->prix/$type->duree;
                $pp2=(($produit2->pourcentage*$produit2->prix)/100);
            }
            $pp+=$pp2;
        }
        if( !empty($request->produit_3_id))
        {
            $produit3=Produit::where('tag',$request->produit_3_id)->first();
            $produit3->vente_count++;
            $produit3->save();
            $vente3->cout=$produit3->prix/$type->duree;
            $vente3->produit_id=$produit3->id;
            if($type->duree==558)
            {
                $vente3->cout=$produit3->prix_2/$type->duree;
                $pp3=(($produit3->pourcentage_2*$produit3->prix_2)/100);
            }
            else
            {
                $vente3->cout=$produit3->prix/$type->duree;
                $pp3=(($produit3->pourcentage*$produit3->prix)/100);
            }
            $pp+=$pp3;
        }
        if( !empty($request->produit_4_id))
        {
            $produit4=Produit::where('tag',$request->produit_4_id)->first();
            $produit4->vente_count++;
            $produit4->save();
            $vente4->cout=$produit4->prix/$type->duree;
            $vente4->produit_id=$produit4->id;
            if($type->duree==558)
            {
                $vente4->cout=$produit4->prix_2/$type->duree;
                $pp4=(($produit4->pourcentage_2*$produit4->prix_2)/100);
            }
            else
            {
                $vente4->cout=$produit4->prix/$type->duree;
                $pp4=(($produit4->pourcentage*$produit4->prix)/100);
            }
            $pp+=$pp4;
        }

        $carte= new Carte;
        $client=Client::where('tag',$request->client_id)->first();
        $agent=$client->agent;
        $carte->client_id=$client->id;
        $carte->tag=$client->tag.'-'.$client->carte_count;
        $client->carte_count++;
        $client->update();
        $carte->duree=$type->duree;
        $carte->tranches=$type->duree;
        $carte->cout=$vente1->cout+$vente2->cout+$vente3->cout+$vente4->cout;
        $carte->completed=false;
        $carte->agent_id=$agent->id;
        $carte->pourcentage=$pp/($carte->duree);
        $carte->save();
        $type->stock--;
       
        $vente1->carte_id=$carte->id;
        $vente2->carte_id=$carte->id;
        $vente3->carte_id=$carte->id;
        $vente4->carte_id=$carte->id;


        $vente1->save();
        $vente2->save();
        $vente3->save();
        $vente4->save();

        $evolution= new Carte_evolution;
        $evolution->carte_id=$carte->id;
        $evolution->mois=1;
        $evolution->jour=0;
        $evolution->save();

        $user=Auth::user();
        $cartes=$client->cartes;
        $cartes_c=$cartes->where('completed', true);
        $cartes_nc=$cartes->where('completed', false);
        return view('administration.clients.client', compact('client','cartes','agent','user','cartes_nc','cartes_c'));

    }
    
    public function carte($id)
    {
        $carte= Carte::findorFail($id);
        $client=$carte->client;
        $agent=$client->agent;
        $ventes=$carte->ventes;
        $paiements=$carte->paiements;
        $evolution=$carte->evolution;
        $produits=array();
        foreach($ventes as $vente )
        {
            array_push($produits, $vente->produit);
        }
        $user=Auth::user();
        return view('administration.clients.card', compact('carte','client','agent','ventes','produits','paiements','evolution','user'));
    }

    public function delete_carte($client_id, $carte_id)
    {
        
        $carte=Carte::findorFail($carte_id);
        $carte->deleted_at=now();
        $carte->update();
        $paiements=$carte->paiements;
        foreach($paiements as $paiement)
        {
            $paiement->delete();
        }
        $client= Client::findorFail($client_id);
        $user=Auth::user();
        $cartes=$client->cartes;
        $cartes_c=$cartes->where('completed', true);
        $cartes_nc=$cartes->where('completed', false);
        $agent=$client->agent;
        return view('administration.clients.client', compact('client','cartes','agent','user','cartes_nc','cartes_c'));
    }
    public function payment_form($client_id, $carte_id)
    {
        $carte=Carte::findorFail($carte_id);
        $client=Client::findorFail($client_id);
        $agent=$client->agent;
        $user=Auth::user();
        return view('administration.clients.payment_form', compact('agent', 'client', 'carte','user'));

    }
    public function payment_form_sample()
    {
        $user=Auth::user();
        return view('administration.clients.payment_form_sample', compact('user'));

    }
    public function payment_store(Request $request)
    {
        $user=Auth::user();
        $agence=$user->agence;
        $caisses=$agence->caisses;
        $carte=Carte::where('tag',$request->carte)->first();
        Paiement_controller::pay($carte, $request->montant);
        $evolution=$carte->evolution;
        $client=$carte->client;
        $agent=$client->agent;
        $agent->revenus+=$request->montant;
        $agent->save();
        $ventes=$carte->ventes;
        $paiements=$carte->paiements;
        $produits=array();
        foreach($ventes as $vente )
        {
            array_push($produits, $vente->produit);
            if($vente->produit!=null)
            {
            $produit=$vente->produit;
            $produit->revenus+=$vente->cout*($request->montant/$carte->cout);
            $produit->save();
            }
        }
        
        return view('administration.clients.card', compact('carte','client','agent','ventes','produits','paiements','evolution','user'));
        

    }
    public function exchange(Request $request)
    {
        $user=Auth::user();
        $agence=$user->agence;
        $caisses=$agence->caisses;
        $carte_m=Carte::where('tag', $request->carte_m)->first();
        $type=Type_carte::where('tag', $request->type)->first();
        $paiements=$carte_m->paiements;
        $solde=0;
        foreach($paiements as $paiement)
        {
            $solde+=$paiement->montant;
            $paiement->delete();
        }
        $transactions=$carte_m->transactions;

        foreach($transactions as $transaction)
        {
            $transaction->delete();
        }
        $ventes=$carte_m->ventes();
        foreach($ventes as $vente)
        {
            $vente->delete;
        }
        $montant=(2/3)*$solde;
        $transaction=new Transaction; //separation des benefices
        $transaction->montant=(1/3)*$solde;
        $transaction->caisse_id=$caisses->where('tag', 'FC')->first()->id;
        $transaction->motif='Frais d\'échange de carte';
        $transaction->save();
        $carte_m->delete();
       //Création de la nouvele carte
        $vente1= new Vente;
        $vente2= new Vente;
        $vente3= new Vente;
        $vente4= new Vente;
        $type=Type_carte::where('tag',$request->type)->first();
        $type->stock--;
        $type->save();
        $pp=0;
        if( !empty($request->produit_1_id))
        {

            $produit1=Produit::where('tag',$request->produit_1_id)->first();
            $produit1->vente_count++;
            $produit1->save();
            $vente1->produit_id=$produit1->id;
            if($type->duree==558)
            {
                $vente1->cout=$produit1->prix_2/$type->duree;
                $pp1=(($produit1->pourcentage_2*$produit1->prix_2)/100);
            }
            else
            {
                $vente1->cout=$produit1->prix/$type->duree;
                $pp1=(($produit1->pourcentage*$produit1->prix)/100);
            }
            $pp+=$pp1;            
        }
        if( !empty($request->produit_2_id))
        {
            $produit2=Produit::where('tag',$request->produit_2_id)->first();
            $produit2->vente_count++;
            $produit2->save();
            $vente2->cout=$produit2->prix/$type->duree;
            $vente2->produit_id=$produit2->id;
            if($type->duree==558)
            {
                $vente2->cout=$produit2->prix_2/$type->duree;
                $pp2=(($produit2->pourcentage_2*$produit2->prix_2)/100);
            }
            else
            {
                $vente2->cout=$produit2->prix/$type->duree;
                $pp2=(($produit2->pourcentage*$produit2->prix)/100);
            }
            $pp+=$pp2;
        }
        if( !empty($request->produit_3_id))
        {
            $produit3=Produit::where('tag',$request->produit_3_id)->first();
            $produit3->vente_count++;
            $produit3->save();
            $vente3->cout=$produit3->prix/$type->duree;
            $vente3->produit_id=$produit3->id;
            if($type->duree==558)
            {
                $vente3->cout=$produit3->prix_2/$type->duree;
                $pp1=(($produit3->pourcentage_2*$produit3->prix_2)/100);
            }
            else
            {
                $vente3->cout=$produit3->prix/$type->duree;
                $pp1=(($produit3->pourcentage*$produit3->prix)/100);
            }
            $pp+=$pp3;
        }
        if( !empty($request->produit_4_id))
        {
            $produit4=Produit::where('tag',$request->produit_4_id)->first();
            $produit4->vente_count++;
            $produit4->save();
            $vente4->cout=$produit4->prix/$type->duree;
            $vente4->produit_id=$produit4->id;
            if($type->duree==558)
            {
                $vente4->cout=$produit4->prix_2/$type->duree;
                $pp1=(($produit4->pourcentage_2*$produit4->prix_2)/100);
            }
            else
            {
                $vente4->cout=$produit4->prix/$type->duree;
                $pp1=(($produit4->pourcentage*$produit4->prix)/100);
            }
            $pp+=$pp4;
        }

        $carte= new Carte;
        $client=Client::where('tag',$request->client_id)->first();
        $agent=$client->agent;
        $carte->client_id=$client->id;
        $carte->tag=$client->tag.'-'.$client->carte_count;
        $client->carte_count++;
        $client->update();
        $carte->duree=$type->duree;
        $carte->tranches=$type->duree;
        $carte->cout=$vente1->cout+$vente2->cout+$vente3->cout+$vente4->cout;
        $carte->completed=false;
        $carte->agent_id=$agent->id;
        $carte->pourcentage=$pp/($carte->duree);
        $carte->save();
       
        $vente1->carte_id=$carte->id;
        $vente2->carte_id=$carte->id;
        $vente3->carte_id=$carte->id;
        $vente4->carte_id=$carte->id;


        $vente1->save();
        $vente2->save();
        $vente3->save();
        $vente4->save();

        $evolution= new Carte_evolution;
        $evolution->carte_id=$carte->id;
        $evolution->mois=1;
        $evolution->jour=0;
        $evolution->save();
        Paiement_controller::pay($carte, $montant);

        return Client_controller::client($client->id);

    }
    public function exchange_form($client_id, $carte_id)
    {
       $user=Auth::user();
       $client=Client::findorFail($client_id);
       $carte=Carte::findorFail($carte_id);
       $types=Type_carte::all();
       $produits_all=Produit::all();
        $produits=array();
        foreach($produits_all as $produit_all)
        {
            array_push($produits,$produit_all->tag);
        }
       
       return view('administration.clients.exchange_form', compact('user','client','carte','types','produits'));

    }
    public function delivery($c_id, $v_id)
    {
        $carte=Carte::findorFail($c_id);
        $carte->LP=true;
        $user=Auth::user();
        $agence=$user->agence;
        $caisses=$agence->caisses;
        $caisse=$caisses->where('tag', 'L')->first();
        $transaction1=new Transaction;
        $transaction1->montant=$carte->cout*$carte->duree;
        $transaction1->caisse_id=$caisse->id;
        $transaction1->motif='Frais de livraison';
        $transaction1->save();
        $client=$carte->client;
        $agent=$client->agent;
        $ventes=$carte->ventes;
        $paiements=$carte->paiements;
        $evolution=$carte->evolution;
        $produits=array();
        foreach($ventes as $vente )
        {
            array_push($produits, $vente->produit);
        }
        return view('administration.clients.card', compact('carte','client','agent','ventes','produits','paiements','evolution','user'));
        
    }
    public static function carte_stock()
    {
        $user=Auth::user();
        $cartes=Type_carte::all();
        $count=0;
        foreach ($cartes as $carte)
        {
            $count+=$carte->stock;
        }
        return view('administration.cartes.cartes', compact('cartes','count','user'));
    }
    public function stock_recharge_form()
    {
        $user=Auth::user();
       $types=Type_carte::all();
       return view('administration.cartes.stock_recharge_form', compact('types','user'));
    }
     public function stock_recharge(Request $request)
    {
        $user=Auth::user();
       $carte=Type_carte::all()->where('tag', $request->type)->first();
       $carte->stock+=$request->quantite;
       $carte->save();
       
       return Carte_controller::carte_stock();
    }
}
