<?php

namespace App\Http\Controllers\API;

use App\Models\Console;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConsoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $joueur = DB::table('consoles')
            ->join('joueurs', 'joueur.id', '=', 'consoles.joueur_id')
            ->get()
            ->toArray();
        // On retourne les informations des utilisateurs en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $joueur,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomConsole' => 'required|max:100',
        ]);
        $Console = Console::create([
            'nomConsole' => $request->nomConsole,
            'joueur_id'=> $request->joueur_id,
        ]);
        return response()->json([
            'status' => 'Success',
            'data' => $Console,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Console $console)
    {
        return response()->json($console);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Console $console)
    {
        $this->validate($request, [
            'nomConsole' => 'required|max:100',
        ]);
        $console->update([
            'nomConsole' => $request->nomConsole,
            'joueur_id'=> $request->joueur_id,

        ]);
        return response()->json([
            'status' => 'Mise à jour avec succèss'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Console $console)
    {
        // On supprime l'utilisateur
        $console->delete();
        return response()->json([
            'status' => 'Supprimer avec succès'
        ]);
    }
}
