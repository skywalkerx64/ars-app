<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Agence;
use App\Models\Client;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Agent_controller extends Controller
{
    public function agents()
    {
        $user=Auth::user();
        $agence=Agence::findorFail($user->agence_id);
        $agents=$agence->agents;
        $clients=Client::where('agence_id', $agence->id);
        
        return view('administration.agents.agents', compact('agents','user','clients'));
    }

    public static function agent($id)
    {
        $agent=Agent::findorFail($id);
        $clients=$agent->clients;
        $cartes_a=array();
        foreach($clients as $client)
        {
            $cartes=$client->cartes;
            foreach($cartes as $carte)
            {
                array_push($cartes_a, $carte);
            }
            
        }
        $paiements= Paiement::where('agent_id', $id)->orderby('id','desc')->get();
        $user=Auth::user();
        return view('administration.agents.agent', compact('agent','user','clients','paiements','cartes_a'));
    }

    public function add_agent()
    {
        $agences=Agence::all();
        $user=Auth::user();
        return view('administration.agents.add_form', compact('user','agences'));
    }
    public function store_agent(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required',
            'prenom'=>'required',
            'adresse'=>'required',
            'age'=>'required',
            'sexe'=>'required',
            'contact'=>'required',
            'urgence_contact'=>'required',
            'diplome'=>'required',
            'agence_id'=>'required',
        ]);
        $agent= new Agent;
        $agent->nom=$request->nom;
        $agent->prenom=$request->prenom;
        $agent->adresse=$request->adresse;
        $agent->age=$request->age;
        $agent->sexe=$request->sexe;
        $agent->contact=$request->contact;
        $agent->urgence_contact=$request->urgence_contact;
        $agent->diplome=$request->diplome;
        $agence=Agence::where('localisation',$request->agence_id)->first();
        $agent->agence_id=$agence->id;
        $agent->tag='AC'.$agence->id.'-'.$agence->agent_count;
        $agence->agent_count++;
        $agence->update();
        $agent->save();
        return Agent_controller::agents();

    }
    public function edit_agent($id)
    {
        $agences=Agence::all();
        $agent=Agent::findorFail($id);
        $user=Auth::user();
        return view('administration.agents.edit_form', compact('user','agent','agences'));

    }
    public function update_agent(Request $request, $id)
    {
        $agent=Agent::findorFail($id);
        $agence=Agence::where('localisation',$request->agence_id)->first();
        $agent->update([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'adresse'=>$request->adresse,
            'contact'=>$request->contact,
            'urgence_contact'=>$request->urgence_contact,
            'age'=>$request->age,
            'sexe'=>$request->sexe,
            'diplome'=>$request->diplome,
            'agence_id'=>$agence->id

        ]);
        return Agent_controller::agent($agent->id);
    }
    public function search(Request $request)
    {
        $user=Auth::user();
        $key=$request->key;
        $agents_all = Agent::query()
            ->where('nom', 'like', "%{$key}%")
            ->orWhere('prenom', 'like', "%{$key}%")
            ->orWhere('id', 'like', "%{$key}%")
            ->orWhere('adresse', 'like', "%{$key}%")
            ->orWhere('contact', 'like', "%{$key}%")
            ->orWhere('urgence_contact', 'like', "%{$key}%")
            ->orWhere('tag', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->get();
            $agents=$agents_all->where('agence_id',$user->agence_id);

        return view('administration.agents.agent_search', compact('agents','user', 'key'));
    }
    public static function best_agents()
    {

        $user=Auth::user();
        $agence=Agence::findorFail($user->agence_id);
        $agents=$agence->agents->sortByDesc('revenus');
        $clients=Client::where('agence_id', $agence->id);
        
        return view('administration.agents.agents', compact('agents','user','clients'));
    }
        public function clients_migrate_form($id)
    {
        $user=Auth::user();
        $agent=Agent::findorFail($id);
        $agence=Agence::findorFail($user->agence_id);
        $agents=Agent::all();
        return view('administration.agents.clients_migrate_form', compact('agents','user','agent'));
    }
    
    public function clients_migrate(Request $request)
    {
        $user=Auth::user();
        $agent=Agent::findorFail($request->id);
        $agent_d=Agent::all()->where('tag',$request->agent_d)->first();
        $agence=Agence::findorFail($agent_d->agence_id);
        $clients=$agent->clients;
        foreach($clients as $client)
        {
            $client->agence_id=$agence->id;
            $client->agent_id=$agent_d->id;
            $client->tag=$agent_d->tag.'-'.$agent_d->client_count;
            $agent_d->client_count++;
            $client->save();
        }
        $agent_d->save();
        return Agent_controller::agent($agent_d->id);
    }
    
    public function client_migrate_form($id)
    {
        $user=Auth::user();
        $client=Client::findorFail($id);
        $agent=$client->agent;
        $agence=Agence::findorFail($user->agence_id);
        $agents=Agent::all();
        return view('administration.agents.client_migrate_form', compact('client','agents','user','agent'));
    }
    
    public function client_migrate(Request $request)
    {
        $user=Auth::user();
        $agent=Agent::findorFail($request->id);
        $client=Client::findorFail($request->id_c);
        $agent_d=Agent::all()->where('tag',$request->agent_d)->first();
        $agence=Agence::findorFail($agent_d->agence_id);
            $client->agence_id=$agence->id;
            $client->agent_id=$agent_d->id;
            $client->tag=$agent_d->tag.'-'.$agent_d->client_count;
            $agent_d->client_count++;
        $agent_d->save();
        $client->save();
        return Agent_controller::agent($agent_d->id);
    }
    
}
