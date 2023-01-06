<?php

namespace App\Charts;

use App\Models\Carte;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Livraisons
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    } 
   
    public function build()
    {
        return $this->chart->lineChart()
            ->setTitle('Livraisons')
            ->setSubtitle('Par jours')
            ->addData(
                \App\Models\Carte::where('completed', '=', true)->count(),
            );
    }
}
