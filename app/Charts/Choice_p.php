<?php

namespace App\Charts;

use App\Models\Carte;
use Illuminate\Support\Collection;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Choice_p
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    } 
   
    public function build()
    {
        $user=Auth::user();
        $produits=Produit::all()->sortByDesc('vente_count')->take(5);
        $produit_data=array();
        $produit_label=array();
        foreach ($produits as $produit)
        {
            array_push($produit_data, $produit->vente_count);
            array_push($produit_label, $produit->intitule.' | '.$produit->tag);
        }
        return $this->chart->barChart()
            ->setTitle('Produit les plus choisis')
            ->setSubtitle('')
            ->addData('Nombre de ventes',$produit_data)
            ->setLabels($produit_label);
    }
}


