<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin_controller;
use App\Http\Controllers\Produit_controller;

class App_controller extends Controller
{
    public function redirect_user()
    {
        $user=Auth::user();
        if ($user->admin)
        {
            Admin_controller::dashboard();
        }
        else
        {
            Produit_controller::catalogue();
        }

    }
}
