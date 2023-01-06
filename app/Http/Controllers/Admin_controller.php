<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Charts\Best_agent;
use App\Charts\Best_produit;
use App\Charts\Choice_p;
use Illuminate\Http\Request;
use App\Charts\Carte_vendues;
use App\Charts\Cartes_rentables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Client_controller;
use App\Http\Controllers\Produit_controller;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class Admin_controller extends Controller
{
    public function home(Carte_vendues $chart_cv, Cartes_rentables $chart_s, Best_agent $chart_ba, Best_produit $chart_bp, Choice_p $chart_cp)
    {
        $user=Auth::user();
        if(!$user->admin)
        {
            return Produit_controller::catalogue();
        }
        else
        {
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
    'condition'=> ['name' => 'Transport' , 'condition' => 'agent_id = 2' , 'color' => 'blue' , 'fill' => true]
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
$agences=Agence::all();

return view('administration.admin', compact('user','mychart','cchart','agences'), ['chart_cv' => $chart_cv->build(),'chart_s' => $chart_s->build(), 'chart_ba' => $chart_ba->build(), 'chart_bp' => $chart_bp->build(),'chart_cp' => $chart_cp->build()]);
        }
        
    }
    public function admin(Carte_vendues $chart_cv, Cartes_rentables $chart_s, Best_agent $chart_ba, Best_produit $chart_bp, Choice_p $chart_cp)
    {
        
        $user=Auth::user();
        if($user->admin)
        {

        
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
$agences=Agence::all();

return view('administration.admin', compact('user','mychart','cchart','agences'), ['chart_cv' => $chart_cv->build(),'chart_s' => $chart_s->build(), 'chart_ba' => $chart_ba->build(), 'chart_bp' => $chart_bp->build(),'chart_cp' => $chart_cp->build()]);
}
else
{
    return Client_controller::clients();
}
    }
}
