<?php

namespace App\Charts;

use App\Models\Carte;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Carte_vendues
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
        $clients=$agence->clients;
        $cartes_all=new Collection;
        foreach ($clients as $client) 
        {
            $cartes=$client->cartes;
            foreach($cartes as $carte)
            {
                $cartes_all->push($carte);
            }
        }
        
        return $this->chart->pieChart()
            ->setTitle('Carte les plus vendues')
            ->setSubtitle('')
            ->addData([
                $cartes_all->where('duree', '=', 372)->count(),
                $cartes_all->where('duree', '=', 558)->count(),
                $cartes_all->where('duree', '=', 124)->count(),
                $cartes_all->where('duree', '=', 186)->count(),
            ])
            ->setLabels(['Cartes de type A', 'Cartes de type B', 'Cartes de type C', 'Cartes de type D']);
    }
}
