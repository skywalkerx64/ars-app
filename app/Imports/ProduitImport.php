<?php

namespace App\Imports;

use App\Models\Produit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProduitImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collections)
    {
        
        foreach ($collections as $collection) 
        {
            
            $produit= new Produit;
            $produit->intitule=$collection['intitule'];
            $produit->description=$collection['description'];
            $produit->prix=$collection['prix'];
            $produit->prix_2=$collection['prix_2'];
            $produit->categorie=$collection['categorie'];;
            $produit->tag=$collection['tag'];
            $produit->pourcentage=$collection['pourcentage'];
            $produit->pourcentage_2=$collection['pourcentage_2'];

            $produit->save();
        }
    }
}
