<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Client;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        $user = Auth::user();
        $totalUsers =User::count(); 
        $totalClients=Client::count();
        $totalFournisseurs=Fournisseur::count();
       return view('dashboard',compact('totalUsers','user','totalClients','totalFournisseurs'));

        // Pass data to the view
        
    }
}
