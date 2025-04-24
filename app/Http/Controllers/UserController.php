<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Client;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'code' => 'required|string|max:255',
        'raison_sociale' => 'required|string|max:255',
        'type_client' => 'required|in:étatique,privée,étranger',
        'num_siret' => 'nullable|string|max:255|required_if:type_client,étranger',
        'adresse' => 'required|string|max:255',
        'matricule_fiscale' => 'required|string|max:255',
        'code_postal' => 'required|string|max:10',
        'activite' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'blockage' => 'required|boolean',
        'exomee' => 'nullable|boolean',
        'num_decision' => 'nullable|string|max:255|required_if:exomee,1',
        'date_debut' => 'nullable|date|required_if:exomee,1',
        'date_fin' => 'nullable|date|required_if:exomee,1|after:date_debut',
    ]);

    // Create the User
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    // Create the Client
    $client = new Client([
        'code' => $validated['code'],
        'raison_sociale' => $validated['raison_sociale'],
        'type_client' => $validated['type_client'],
        'num_siret' => $validated['num_siret'] ?? null,
        'adresse' => $validated['adresse'],
        'matricule_fiscale' => $validated['matricule_fiscale'],
        'code_postal' => $validated['code_postal'],
        'activite' => $validated['activite'],
        'telephone' => $validated['telephone'],
        'blockage' => $validated['blockage'],
        'exomee' => $validated['exomee'] ?? false,
        'num_decision' => $validated['num_decision'] ?? null,
        'date_debut' => $validated['date_debut'] ?? null,
        'date_fin' => $validated['date_fin'] ?? null,
    ]);

    // Associate the Client with the User
    $user->client()->save($client);

    return redirect()->route('users.index')->with('success', 'User and Client created successfully.');
}
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
{
    // Validate the request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8', // Optional if not changing password
        'code' => 'required|string|max:255',
        'raison_sociale' => 'required|string|max:255',
        'type_client' => 'required|in:étatique,privée,étranger',
        'num_siret' => 'nullable|string|max:255|required_if:type_client,étranger',
        'adresse' => 'required|string|max:255',
        'matricule_fiscale' => 'required|string|max:255',
        'code_postal' => 'required|string|max:10',
        'activite' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'blockage' => 'required|boolean',
        'exomee' => 'nullable|boolean',
        'num_decision' => 'nullable|string|max:255|required_if:exomee,1',
        'date_debut' => 'nullable|date|required_if:exomee,1',
        'date_fin' => 'nullable|date|required_if:exomee,1|after:date_debut',
    ]);

    // Find the user
    $user = User::findOrFail($id);

    // Update the user's details
    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password, // Only update if a new password is provided
    ]);

    // Update the related client details
    $user->client()->update([
        'code' => $validated['code'],
        'raison_sociale' => $validated['raison_sociale'],
        'type_client' => $validated['type_client'],
        'num_siret' => $validated['num_siret'] ?? null,
        'adresse' => $validated['adresse'],
        'matricule_fiscale' => $validated['matricule_fiscale'],
        'code_postal' => $validated['code_postal'],
        'activite' => $validated['activite'],
        'telephone' => $validated['telephone'],
        'blockage' => $validated['blockage'],
        'exomee' => $validated['exomee'] ?? false,
        'num_decision' => $validated['num_decision'] ?? null,
        'date_debut' => $validated['date_debut'] ?? null,
        'date_fin' => $validated['date_fin'] ?? null,
    ]);

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
