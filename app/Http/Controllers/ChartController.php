<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Charts\ProduitChart;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chart= new ProduitChart;
        $categories=Categorie::all();
        $categorie_all=new Collection;
        foreach($categories as $categorie)
        {
            $categorie_all->collect($categorie->intitule);
        }
        $usersChart->labels($categorie_all);
        $usersChart->dataset('Users by trimester', 'line', [10, 25, 13]);

    }

}