<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProduitImport;
use App\Imports\PaiementImport;
use Maatwebsite\Excel\Facades\Excel;

class Imports_controller extends Controller
{
    public function products_import(Request $request)
    {   
        Excel::import(new ProduitImport, $request->file);
        return redirect()->action([Produit_controller::class, 'catalogue']);
    }
    public function payment_csv_import(Request $request)
    {  
        Excel::import(new PaiementImport, $request->file);
        return redirect()->action([Produit_controller::class, 'catalogue']);
    }
    
}
