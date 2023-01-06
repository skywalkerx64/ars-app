<?php

namespace App\Charts;

use App\Models\Carte;
use App\Models\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Best_agent
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    } 
   
    public function build()
    {
        $user=Auth::user();
        $agence=$user->agence;
        $agents=$agence->agents->sortByDesc('revenus')->take(5);
        $agent_data=array();
        $agent_label=array();
        foreach ($agents as $agent)
        {
            array_push($agent_data, $agent->revenus);
            array_push($agent_label, $agent->prenom.' '.$agent->nom.' | '.$agent->tag);
        }
        return $this->chart->barChart()
            ->setTitle('Meilleures agents')
            ->setSubtitle('')
            ->addData('Chiffre d\'affaire généré',$agent_data)
            ->setLabels($agent_label)
            ->setToolBar(true, true);
    }
}
