<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Agent;
use App\Models\Carte;
use App\Models\Vente;
use App\Models\Agence;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Type_carte;
use Illuminate\Http\Request;
use App\Models\Carte_evolution;
use JeroenDesloovere\VCard\VCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Client_controller extends Controller
{
    public static function clients()
    {
        $user=Auth::user();
        $agence=Agence::findorFail($user->agence_id);
        $clients=$agence->clients;
        return view('administration.clients.clients', compact('clients','user'));
    }
    public static function client($id)
    {
        $user=Auth::user();
        $client= Client::findorFail($id);
        $cartes=$client->cartes;
        $cartes_c=$cartes->where('completed', true);
        $cartes_nc=$cartes->where('completed', false);
        $agent=$client->agent;
        return view('administration.clients.client', compact('client','cartes','agent','user','cartes_nc','cartes_c'));
    }
        public static function client_edit($id)
    {
        $user=Auth::user();
        $client= Client::findorFail($id);

        return view('administration.clients.client_edit', compact('client','user'));
    }
    public static function edit_store_client(Request $request)
    {
        $client= Client::findorFail($request->id);
        $client->nom=$request->nom;
        $client->prenom=$request->prenom;
        $client->age=$request->age;
        $client->adresse=$request->adresse;
        $client->contact=$request->contact;
        $client->region=$request->region;
        $client->update();
        $user=Auth::user();
        return Client_controller::client($client->id);
    }
    
    public function search(Request $request)
    {
        $user=Auth::user();
        $key=$request->key;
        $clients_all = Client::query()
            ->where('nom', 'like', "%{$key}%")
            ->orWhere('prenom', 'like', "%{$key}%")
            ->orWhere('id', 'like', "%{$key}%")
            ->orWhere('adresse', 'like', "%{$key}%")
            ->orWhere('contact', 'like', "%{$key}%")
            ->orWhere('region', 'like', "%{$key}%")
            ->orWhere('tag', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->get();
            $clients=$clients_all->where('agence_id',$user->agence_id);

        return view('administration.clients.client_search', compact('clients','user', 'key'));
    }
    public function add_client()
    {
        $user=Auth::user();
        $agence=$user->agence;
        $agents=$agence->agents;
        return view('administration.clients.add_client_form', compact('agents','user'));
    }
    public function add_client_agent($id)
    {
        $user=Auth::user();
        $agents= Agent::findorFail($id);
        return view('administration.clients.add_client_agent_form', compact('agents','user'));
    }
    public function store_client(Request $request)
    {
        $agent=Agent::where('tag',$request->agent_id)->first();
        $agence=$agent->agence;
        $client= new Client;
        $client->nom=$request->nom;
        $client->prenom=$request->prenom;
        $client->age=$request->age;
        $client->adresse=$request->adresse;
        $client->contact=$request->contact;
        $client->agent_id=$agent->id;
        $client->agence_id=$agence->id;
        $client->region=$request->region;
        $client->tag=$agent->tag.'-'.$agent->client_count;
        $agent->client_count++;
        $agent->update();
        $client->save();
        $user=Auth::user();
        $clients=$agence->clients;
        return Agent_controller::agent($agent->id);

    }
    public function export($id)
    {
        $client=Client::findorFail($id);
        $vcard = new VCard();
        $lastname = $client->nom;
        $firstname = $client->prenom;
        $additional = '';
        $prefix = '';
        $suffix = '';

        // add personal data
        $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

        // add work data
        $vcard->addPhoneNumber($client->contact, 'PREF;WORK');
        $vcard->addAddress(null, null, $client->adresse, '', null, '', $client->region);

        return $vcard->download();
        
    }
    public function exports()
    {
        $clients=Client::all();
        $zip = new ZipArchive();
        $zipname='contacts.zip'; 
        if($zip->open(storage_path('app/public').$zipname, ZipArchive::CREATE) === true)
        {
            foreach($clients as $client)
        {
            $vcard = new VCard();
            $lastname = $client->nom;
            $firstname = $client->prenom;
            $additional = '';
            $prefix = '';
            $suffix = '';
    
            // add personal data
            $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);
    
            // add work data
            $vcard->addPhoneNumber($client->contact, 'PREF;WORK');
            $vcard->addAddress(null, null, $client->adresse, '', null, '', $client->region);
            $vcard->download();
        }

        }

        
    }
    public function add_client_carte($id)
    {
        $user=Auth::user();
        $agent= Agent::findorFail($id);
        $types=Type_carte::all();
        $produits_all=Produit::all();
        $produits=array();
        foreach($produits_all as $produit_all)
        {
            array_push($produits,$produit_all->tag);
        }
        return view('administration.clients.add_client_card', compact('agent','types','user','produits')); 
    }
    public function store_client_carte(Request $request)
    {
            $agent=Agent::where('tag',$request->agent_id)->first();
            $agence=$agent->agence;
            $client= new Client;
            $client->nom=$request->nom;
            $client->prenom=$request->prenom;
            $client->age=$request->age;
            $client->adresse=$request->adresse;
            $client->contact=$request->contact;
            $client->agent_id=$agent->id;
            $client->agence_id=$agence->id;
            $client->region=$request->region;
            $client->carte_count=1;
            $client->tag=$agent->tag.'-'.$agent->client_count;
            $agent->client_count++;
            $agent->update();
            $client->save();
    
            ///
    
            $vente1= new Vente;
            $vente2= new Vente;
            $vente3= new Vente;
            $vente4= new Vente;
            $type=Type_carte::where('tag',$request->type)->first();
            $pp=0;
            if( !empty($request->produit_1_id))
            {
    
                $produit1=Produit::where('tag',$request->produit_1_id)->first();
                $vente1->produit_id=$produit1->id;
                $produit1->vente_count++;
                $produit1->save();
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
    
            $user=Auth::user();
            return view('administration.clients.payment_form', compact('agent', 'client', 'carte','user'));
    }
}
