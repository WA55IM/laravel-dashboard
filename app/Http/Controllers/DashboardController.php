<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        $user = Auth::user();
        $totalUsers =User::count(); 
       return view('dashboard',compact('totalUsers','user'));

        // Pass data to the view
        
    }
}
