<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Ventes_produit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Change_produit_historique;

class Produit_controller extends Controller
{
    public static function catalogue()
    {
        $produits=Produit::all();
        $user=Auth::user();
        $categories= Categorie::all();

        return view('catalogue.catalogue', compact('produits','user','categories'));
    }
        public static function catalogue_best()
    {
        $produits=Produit::all()->sortByDesc('revenus');
        $user=Auth::user();
        $categories= Categorie::all();

        return view('catalogue.catalogue_best', compact('produits','user','categories'));
    }
            public static function catalogue_best_choices()
    {
        $produits=Produit::all()->sortByDesc('vente_count');
        $user=Auth::user();
        $categories= Categorie::all();

        return view('catalogue.catalogue_best', compact('produits','user','categories'));
    }
    public function catalogue_sort_categorie($categorie)
    {
        $produits=Produit::where('categorie', $categorie)->get();
        $user=Auth::user();
        $categories= Categorie::all();

        return view('catalogue.catalogue', compact('produits','user','categories'));
    }
    public function add_form()
    {
        $user=Auth::user();
        if($user->admin)
        {
            $categories= Categorie::all();
            return view('catalogue.add_product_form', compact('categories','user'));
        }
        else
        {
            $error_message='Vous n\'avez les autorisations nécéssaires pour accéder à cette page. Contactez votre administrateur logicielle pour les avoir';
            return view('errors.error_page',compact('error_message'));
        }
        
    }
    public function store_produit(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|unique:produits|max:255',
            'tag'=>'required|unique:produits|max:255',
            'prix'=>'required',
            'pourcentage'=>'required',
            'prix_alt'=>'required',
            'pourcentage_alt'=>'required',
            'categorie'=>'required',
            'description'=>'required',
            'image'=>'required'
        ]);
       $produit= new Produit;
       $produit->intitule=$request->intitule;
       $produit->description=$request->description;
       $produit->prix=$request->prix;
       $produit->prix_2=$request->prix_alt;
       $produit->categorie=$request->categorie;
       $produit->tag=$request->tag;
       $produit->pourcentage=$request->pourcentage;
       $produit->pourcentage_2=$request->pourcentage_alt;
       $produit->image=Storage::disk('public')->put('public/product_images',$request->image);
       $produit->save();
       $v_count=new Ventes_produit;
       $v_count->produit_id=$produit->id;
       $v_count->save();
       $produits= Produit::all();
       $categories= Categorie::all();
       $user=Auth::user();
       $categories= Categorie::all();
       return view('catalogue.catalogue', compact('produits','user','categories'));
    }

    public function product_details($id)
    {
        $produit=Produit::findorFail($id);
        $user=Auth::user();
        return view('catalogue.product_page', compact('produit','user'));
    }

    public function product_edit($id)
    {
        
        $user=Auth::user();
        if($user->admin)
        {
            $categories= Categorie::all();
        $produit=Produit::findorFail($id);
        return view('catalogue.product_edit_page', compact('produit','user','categories'));
        }
        else
        {
            $error_message='Vous n\'avez les autorisations nécéssaires pour accéder à cette page. Contactez votre administrateur logicielle pour les avoir';
            return view('errors.error_page',compact('error_message'));
        }
        
        
    }
    public function product_update(Request $request, $id)
    {
        
        $produit= Produit::findorFail($id);
        if($request->image!=null)
        {
        $image=Storage::disk('public')->put('public/product_images',$request->image);
        Storage::delete($produit->image);
        $produit->update([
            'intitule'=>$request->intitule, 
            'description'=>$request->description,
            'prix'=>$request->prix,
            'prix_2'=>$request->prix_alt,
            'categorie'=>$request->categorie,
            'tag'=>$request->tag,
            'pourcentage'=>$request->pourcentage,
            'pourcentage_2'=>$request->pourcentage_alt,
            'image'=>$image
         ]);
        }
        else
        {
            $produit->update([
                'intitule'=>$request->intitule, 
                'description'=>$request->description,
                'prix'=>$request->prix,
                'prix_2'=>$request->prix_alt,
                'categorie'=>$request->categorie,
                'tag'=>$request->tag,
                'pourcentage'=>$request->pourcentage,
                'pourcentage_2'=>$request->pourcentage_alt,
             ]); 
        }
        
        $user=Auth::user();
        $categories= Categorie::all();
        $produits= Produit::all();
        return view('catalogue.catalogue', compact('produits','user','categories'));
    }

    public function product_delete($id)
    {
        $user=Auth::user();
        if($user->admin)
        {
        $produit=Produit::findorFail($id);
        $produit->delete();
        Storage::delete($produit->image);
       
        $produits= Produit::all();
        $categories= Categorie::all();
        
        return view('catalogue.catalogue', compact('produits','user','categories'));
        }
        else
        {
            $error_message='Vous n\'avez les autorisations nécéssaires pour accéder à cette page. Contactez votre administrateur logicielle pour les avoir';
            return view('errors.error_page',compact('error_message'));
        }
        
    }

    public function search(Request $request)
    {
        $key=$request->key;
        $produits = Produit::query()
            ->where('intitule', 'like', "%{$key}%")
            ->orWhere('description', 'like', "%{$key}%")
            ->orWhere('categorie', 'like', "%{$key}%")
            ->orWhere('tag', 'like', "%{$key}%")
            ->get();
            $categories= Categorie::all();
            $user=Auth::user();
            return view('catalogue.catalogue', compact('produits','user','categories'));
    }
    public function modify_price_form($id)
    {
        $user=Auth::user();
        $produit=Produit::findorFail($id);
        return view('catalogue.price_change_form', compact('user', 'produit'));
    }
    public function price_change(Request $request)
    {  
        $user=Auth::user();
        $produit=Produit::findorFail($request->id);
        $ventes=$produit->ventes;
        foreach($ventes as $vente)
        {
            $carte=$vente->carte;
            if($carte->duree==558)
            {
                $carte->cout=$carte->cout-($produit->prix_2/$carte->duree)+($request->prix_2/$carte->duree);
                $carte->pourcentage=$carte->pourcentage-($produit->pourcentage_2*$produit->prix_2/100/372)+($request->pourcentage_2*$request->prix_2/100/372);
                $vente->cout=$request->prix_2/$carte->duree;
                $vente->save();
                $carte->save();
            }
            else
            {
                $carte->cout=$carte->cout-($produit->prix/$carte->duree)+($request->prix/$carte->duree);
                $carte->pourcentage=$carte->pourcentage-($produit->pourcentage*$produit->prix/100/372)+($request->pourcentage*$request->prix/100/372);
                $vente->cout=$request->prix/$carte->duree;
                
                $vente->save();
                $carte->save();
            }
            

            
            
        }
        $history=new Change_produit_historique;

        $history->produit_id=$produit->id;

        $history->changes_count=$produit->change_price_count;

        $history->previous_prix=$produit->prix;
        $history->previous_prix_2=$produit->prix_2;

        $history->new_prix=$request->prix;
        $history->new_prix_2=$request->prix_2;

        $history->montant=$request->prix-$produit->prix;
        $history->montant_2=$request->prix_2-$produit->prix_2;
        $history->save();

        $produit->prix=$request->prix;
        $produit->prix_2=$request->prix_2;
        $produit->pourcentage=$request->pourcentage;
        $produit->pourcentage_2=$request->pourcentage_2;
        $produit->save();
        

        return Produit_controller::product_details($produit->id);
    }
}
