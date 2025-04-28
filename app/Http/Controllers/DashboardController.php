<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Client;
use App\Models\Compte;
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
        $totalComptes=Compte::count();
       return view('dashboard',compact('totalUsers','user','totalClients','totalFournisseurs','totalComptes'));
    }
    public function client(Request $request)
    {
        $query = Client::query();
        
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('raison_sociale', 'like', "%{$search}%")
                  ->orWhere('matricule_fiscale', 'like', "%{$search}%")
                  ->orWhere('adresse', 'like', "%{$search}%")
                  ->orWhere('code_postal', 'like', "%{$search}%")
                  ->orWhere('activite', 'like', "%{$search}%");
            });
        }
        
        $clients = $query->paginate(15); // Changed from get() to paginate()
        return view('clients', compact('clients'));
    }
}
