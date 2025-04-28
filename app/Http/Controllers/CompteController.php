<?php

namespace App\Http\Controllers;
use App\Models\Compte;
use App\Models\User;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Compte::with('user');
    
        // Apply search filter if a search term is provided
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nom_bank', 'like', "%{$search}%")
                  ->orWhere('rib', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }
    
        $comptes = $query->paginate(10); // Paginate results
        return view('comptes.index', compact('comptes'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = User::where('type_user', 'client')->get(); // Fetch clients
        $fournisseurs = User::where('type_user', 'fournisseur')->get(); // Fetch fournisseurs

        return view('comptes.create', compact('clients', 'fournisseurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_bank' => 'required|string|max:255',
            'rib' => 'required|string|max:255',
            'iban' => 'nullable|string|max:255',
            'swift' => 'nullable|string|max:255',
            'type_compt' => 'required|in:client,fournisseur',
            'user_id' => 'required|exists:users,id',
        ]);

        Compte::create($validated);

        return redirect()->route('comptes.index')->with('success', 'Compte created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compte $compte)
    {
        $clients = User::where('type_user', 'client')->get();
        $fournisseurs = User::where('type_user', 'fournisseur')->get();

        return view('comptes.edit', compact('compte', 'clients', 'fournisseurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compte $compte)
    {
        $validated = $request->validate([
            'nom_bank' => 'required|string|max:255',
            'rib' => 'required|string|max:255',
            'iban' => 'nullable|string|max:255',
            'swift' => 'nullable|string|max:255',
            'type_compt' => 'required|in:client,fournisseur',
            'user_id' => 'required|exists:users,id',
        ]);

        $compte->update($validated);

        return redirect()->route('comptes.index')->with('success', 'Compte updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compte $compte)
    {
        $compte->delete();
        return redirect()->route('comptes.index')->with('success', 'Compte deleted successfully.');
    }
}
