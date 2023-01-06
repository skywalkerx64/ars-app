<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ville;
use App\Models\Agence;
use App\Models\Caisse;
use App\Models\Quartier;
use App\Models\Departement;
use App\Models\Transaction;
use App\Charts\Best_agent_g;
use App\Charts\Best_produit;
use Illuminate\Http\Request;
use App\Charts\Carte_vendues_g;
use Illuminate\Validation\Rules;
use App\Charts\Cartes_rentables_g;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class Setting_controller extends Controller
{
   public function agences(Carte_vendues_g $chart_cv, Cartes_rentables_g $chart_s, Best_agent_g $chart_ba, Best_produit $chart_bp)
   {
        $user=Auth::user();
        $agence=Agence::findorFail($user->agence_id);
        $agences=Agence::all();
        $key='';
        //prepare the charts
        $chart_options1 = [
            'chart_title' => 'Revenus',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Paiement',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'aggregate_function' => 'sum' ,
            'aggregate_field' => 'montant' ,
        ];
        $chart_options2 = [
            'chart_title' => 'Clients',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Client',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line'
            
        ];
        $mychart = new LaravelChart($chart_options1);
        $cchart= new LaravelChart($chart_options2);
       return view('settings.agences', compact('agences','user','agence','key','mychart','cchart'), ['chart_cv' => $chart_cv->build(),'chart_s' => $chart_s->build(), 'chart_ba' => $chart_ba->build(), 'chart_bp' => $chart_bp->build()]);
   }
   public function agence($id)
   {
        $user=Auth::user();
        $agence=Agence::findorFail($id);
        $agents=$agence->agents;
        $utilisateurs=$agence->users;
        
        
        
       return view('settings.agence', compact('agence','user','utilisateurs','agents'));
   }
   public function agence_search(Request $request)
   {
    $user=Auth::user();
    $key=$request->key;
    $agences=Agence::query()
    ->where('localisation', 'like', "%{$key}%")
    ->orWhere('tag', 'like', "%{$key}%")
    ->get();
    $agence=Agence::findorFail($user->agence_id);

    return view('settings.agence_search', compact('agences','user','agence','key'));
   }
   public function agence_add()
   {
        $user=Auth::user();
        $departements=Departement::all();
        $villes=Ville::all();
        $quartiers=Quartier::all();
       return view('settings.agence_add_form', compact('departements','villes','quartiers','user'));
   }
   public function agence_store(Request $request)
   {
       $agence= new Agence;
       $departement=Departement::where('nom', $request->departement)->first();
       $ville=Ville::where('nom', $request->ville)->first();
       $quartier=Quartier::where('nom', $request->quartier)->first();
       $agence->localisation=$ville->nom.' | '.$quartier->nom;
       $agence->tag=$departement->tag.'-'.$ville->tag.$ville->agence_count.'-'.$quartier->tag;
       $ville->agence_count++;
       $ville->update();
       $agence->save();

       //Creation des caisses par défaut
       $caisse_c1=new Caisse;
       $caisse_c1->intitule='Caisse verte';
       $caisse_c1->tag='C1';
       $caisse_c1->agence_id=$agence->id;

       $caisse_c2=new Caisse;
       $caisse_c2->intitule='Caisse jaune';
       $caisse_c2->tag='C2';
       $caisse_c2->agence_id=$agence->id;

       $caisse_c3=new Caisse;
       $caisse_c3->intitule='Caisse bleue';
       $caisse_c3->tag='C3';
       $caisse_c3->agence_id=$agence->id;

       $caisse_b=new Caisse;
       $caisse_b->intitule='Caisse benefices';
       $caisse_b->tag='B';
       $caisse_b->agence_id=$agence->id;

       $caisse_ca=new Caisse;
       $caisse_ca->intitule='Caisse agence';
       $caisse_ca->tag='CA';
       $caisse_ca->agence_id=$agence->id;

       $caisse_fc=new Caisse;
       $caisse_fc->intitule='Frais de conversion de carte';
       $caisse_fc->tag='FC';
       $caisse_fc->agence_id=$agence->id;
       
       $caisse_l=new Caisse;
       $caisse_l->intitule='Livraison';
       $caisse_l->tag='L';
       $caisse_l->agence_id=$agence->id;

       $caisse_gps=new Caisse;
       $caisse_gps->intitule='Frais de gps';
       $caisse_gps->tag='GPS';
       $caisse_gps->agence_id=$agence->id;
       
       $caisse_b->save();
       $caisse_c1->save();
       $caisse_c2->save();
       $caisse_c3->save();
       $caisse_ca->save();
       $caisse_fc->save();
       $caisse_gps->save();
       $caisse_l->save();
       
       
        $user=Auth::user();
        $agence=$user->agence;
        $agences=Agence::all();
        $chart0= new LarapexChart;
    $chart1= new LarapexChart;
    $chart2= new LarapexChart;
    $chart3= new LarapexChart;
    $chart_cv= new Carte_vendues_g($chart0);
    $chart_s= new Cartes_rentables_g($chart1);
    $chart_ba= new Best_agent_g($chart2);
    $chart_bp= new  Best_produit($chart3);

    return Setting_controller::agences($chart_cv,  $chart_s,  $chart_ba,  $chart_bp);
   }

   public function agence_fusion_form()
   {
    $user=Auth::user();
    $agences=Agence::all();
    return view('settings.agence_fusion_form', compact('user','agences'));

   }
   public function agence_fusion(Request $request)
   {
       $agence_m=Agence::where('localisation', $request->agence_1)->first();
       $agence_f=Agence::where('localisation', $request->agence_2)->first();

       $chart0= new LarapexChart;
       $chart1= new LarapexChart;
       $chart2= new LarapexChart;
       $chart3= new LarapexChart;
       $chart_cv= new Carte_vendues_g($chart0);
       $chart_s= new Cartes_rentables_g($chart1);
       $chart_ba= new Best_agent_g($chart2);
       $chart_bp= new  Best_produit($chart3);
   
       return Setting_controller::agences($chart_cv,  $chart_s,  $chart_ba,  $chart_bp);

   }

   //departements
   public function departements()
   {
       $user=Auth::user();
       $departements=Departement::all();
       return view('settings.departement', compact('departements','user'));
   }
   public function departements_add()
   {
       $user=Auth::user();
       return view('settings.departement_add', compact('user'));
   }
   public function departements_store(Request $request)
   {
        $departement= new Departement;
        $departement->nom=$request->nom;
        $departement->tag=$request->tag;
        $departement->save();
        return Setting_controller::departements();
   }
   //villes
   public function villes()
   {
       $user=Auth::user();
       $villes=Ville::all();
       return view('settings.ville', compact('villes','user'));
   }
   public function villes_add()
   {
       $user=Auth::user();
       return view('settings.ville_add', compact('user'));
   }
   public function villes_store(Request $request)
   {
        $ville= new Ville;
        $ville->nom=$request->nom;
        $ville->tag=$request->tag;
        $ville->save();
        return Setting_controller::villes();
   }
   //quartiers
   public function quartiers()
   {
       $user=Auth::user();
       $quartiers=Quartier::all();
       return view('settings.quartier', compact('quartiers','user'));
   }
   public function quartiers_add()
   {
       $user=Auth::user();
       return view('settings.quartier_add', compact('user'));
   }
   public function quartiers_store(Request $request)
   {
        $quartier= new Quartier;
        $quartier->nom=$request->nom;
        $quartier->tag=$request->tag;
        $quartier->save();
        return Setting_controller::quartiers();
   }
   public function user_agence_change_form()
   {
    $user=Auth::user();
    $agence=Agence::findorFail($user->agence_id);
    $agences=Agence::all();
    return view('settings.user_agence_change',compact('user','agence','agences'));
       
   }
   public function user_agence_change($id)
   {
    $user=Auth::user();
    $user->agence_id=$id;
    $user->update();
    $chart0= new LarapexChart;
    $chart1= new LarapexChart;
    $chart2= new LarapexChart;
    $chart3= new LarapexChart;
    $chart_cv= new Carte_vendues_g($chart0);
    $chart_s= new Cartes_rentables_g($chart1);
    $chart_ba= new Best_agent_g($chart2);
    $chart_bp= new  Best_produit($chart3);

    return Setting_controller::agences($chart_cv,  $chart_s,  $chart_ba,  $chart_bp); 

   }
   public function user_agence_add_form($id)
   {
        $user=Auth::user();
       $agence=Agence::findorFail($id);
       return view('settings.user_agence_add_form', compact('user','agence'));

   }
   public function user_store(Request $request)
   {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', Rules\Password::defaults()],
    ]);
    $agence=Agence::where('tag', $request->agence_id)->first();
    $admin=false;
    if($request->admin=='Oui')
    {
        $admin=true;
    }
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'agence_id'=>$agence->id,
        'admin'=>$admin,
        'poste'=>$request->poste
        
    ]);

    event(new Registered($user));
    return Setting_controller::agence($agence->id);

   }
   public function user($id)
   {
    $user=Auth::user();
    $user_c=User::findorFail($id);
    return view('settings.user', compact('user','user_c'));

   }
   public function user_edit_form($id)
   {
       $agences=Agence::all();
        $user=Auth::user();
        $user_c=User::findorFail($id);
       return view('settings.user_edit_form', compact('user','user_c','agences'));

   }
   public function user_edit(Request $request)
   {
    $agence=Agence::where('tag', $request->agence_id)->first();
    $admin=false;
    if($request->admin=='Oui')
    {
        $admin=true;
    }
       $user_c=User::findorFail($request->id);
       $user_c->email=$request->email;
       $user_c->name=$request->name;
       $user_c->agence_id=$agence->id;
       $user_c->admin=$admin;
       $user_c->password=Hash::make($request->password);
       $user_c->update();
       return Setting_controller::agence($agence->id);


   }
   public function user_delete($id)
   {
    $user=Auth::user();
    $user_c=User::findorFail($id);
    $agence=$user_c->agence;
    $user_c->delete();
    return Setting_controller::agence($agence->id);
   }
   public function caisses()
   {
       $user=Auth::user();
       $agence=$user->agence;
       $caisses=Caisse::all();

       $caisse_bf=$caisses->where('tag', 'B')->first();
       $bf_transactions=Transaction::where('motif', 'Bénéfice')->get();
       if($bf_transactions!=null)
        {
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
    }

       $caisse_fa=$caisses->where('tag', 'C2')->first();
       $fa_transactions=Transaction::where('motif', 'Paiement de carte C2')->get();
       if($fa_transactions!=null)
       {
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
    }

       $caisse_c1=$caisses->where('tag', 'C1')->first();
       $c1_transactions=Transaction::where('motif', 'Paiement de carte C1')->get();
       if($c1_transactions!=null)
       {
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
    }

       $caisse_c3=$caisses->where('tag', 'C3')->first();
       $c3_transactions=Transaction::where('motif', 'Paiement de carte C3')->get();
       if($c3_transactions!=null)
        {
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
    }

       $caf=$caisse_c3->solde+$caisse_c1->solde+$caisse_fa->solde+$caisse_bf->solde;

       return view('settings.caisses', compact('user','caisse_bf','caisse_fa','caisse_c1','caisse_c3','caf'));
   }
   public function caisse($tag)
   {
       $user=Auth::user();
       $agence=$user->agence;
       $caisses=Caisse::all();

       $transactions=array();

       $caisse=$caisses->where('tag', $tag)->get();
       foreach($caisse as $caisse_o)
       {
           $transactions_this=$caisse_o->transactions;

           foreach($transactions_this as $transaction_this)
           {
            array_push($transactions, $transaction_this );
           }
        
       }

       

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

       return view('settings.caisse', compact('user','caisse','transactions'));
   }
}
