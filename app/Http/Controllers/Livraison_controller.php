<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification_livraison;

class Livraison_controller extends Controller
{
    public function livraisons()
    {
        $notifs=Notification_livraison::all()->sortByDesc('id');
        $notifs_m=$notifs->where('categorie', 'M')->sortByDesc('id');
        $notifs_c=$notifs->where('categorie', 'C')->sortByDesc('id');
        $notifs_nc=$notifs->where('categorie', 'NC')->sortByDesc('id');
        
        $user=Auth::user();
        return view('livraison.notifications', compact('user','notifs','notifs_c','notifs_m','notifs_nc'));
    }
}
