<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Joueur;
use Illuminate\Http\Request;

class JoueurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // On récupère tous les utilisateurs
        $joueur = Joueur::all();
        // On retourne les informations des utilisateurs en JSON
        return response()->json($joueur);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomJoueur' => 'required|max:100',
            'prenomJoueur' => 'required|max:100',
            'niveau' => 'required|max:100',
        ]);
        // On crée un nouvel utilisateur
        $joueur = Joueur::create([
            'nomJoueur' => $request->nomJoueur,
            'prenomJoueur' => $request->prenomJoueur,
            'niveau' => $request->niveau,
        ]);
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $joueur,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Joueur $joueur)
    {
        // On retourne les informations de l'utilisateur en JSON
        return response()->json($joueur);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Joueur $joueur)
    {   
        
        $this->validate($request, [
            'nomJoueur' => 'required|max:100',
            'prenomJoueur' => 'required|max:100',
            'niveau' => 'required|max:100',
        ]);
        
        // On crée un nouvel utilisateur
        $joueur->update([
            'nomJoueur' => $request->nomJoueur,
            'prenomJoueur' => $request->prenomJoueur,
            'niveau' => $request->niveau,

        ]);
        // On retourne les informations du nouvel utilisateur en JSON
        return response()->json([
            'status' => 'Mise à jour avec succèss'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Joueur $joueur)
    {
        // On supprime l'utilisateur
        $joueur->delete();
        // On retourne la réponse JSON
        return response()->json([
            'status' => 'Supprimer avec succès avec succèss'
        ]);
    }
}
