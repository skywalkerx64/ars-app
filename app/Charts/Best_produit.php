<?php

namespace App\Charts;

use App\Models\Carte;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Best_produit
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    } 
   
    public function build()
    {
        $user=Auth::user();
        $produits=Produit::all()->sortByDesc('revenus')->take(5);
        $produit_data=array();
        $produit_label=array();
        foreach ($produits as $produit)
        {
            array_push($produit_data, $produit->revenus);
            array_push($produit_label, $produit->intitule.' | '.$produit->tag);
        }
        return $this->chart->barChart()
            ->setTitle('Meilleures produits')
            ->setSubtitle('')
            ->addData('Chiffre d\'affaire généré',$produit_data)
            ->setLabels($produit_label);
    }
}
