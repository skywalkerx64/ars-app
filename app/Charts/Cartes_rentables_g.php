<?php

namespace App\Charts;

use App\Models\Carte;
use App\Models\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Cartes_rentables_g
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
        $clients=Client::all();
        $cartes_all=new Collection;
        foreach ($clients as $client) 
        {
            $cartes=$client->cartes;
            foreach($cartes as $carte)
            {
                $cartes_all->push($carte);
            }
        }
        $cartes_a=$cartes_all->where('duree', '=', 372);
        $cartes_b=$cartes_all->where('duree', '=', 558);
        $cartes_c=$cartes_all->where('duree', '=', 124);
        $cartes_d=$cartes_all->where('duree', '=', 186);
        return $this->chart->pieChart()
            ->setTitle('Carte les plus soldées')
            ->setSubtitle('')
            ->addData([
                $cartes_a->where('completed', '=', true)->count(),
                $cartes_b->where('completed', '=', true)->count(),
                $cartes_c->where('completed', '=', true)->count(),
                $cartes_d->where('completed', '=', true)->count(),
            ])
            ->setLabels(['Cartes de type A', 'Cartes de type B', 'Cartes de type C', 'Cartes de type D']);
    }
}

