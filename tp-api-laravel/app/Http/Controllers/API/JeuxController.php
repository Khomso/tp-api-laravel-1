<?php

namespace App\Http\Controllers\API;

use App\Models\Jeux;
use App\Models\Console;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JeuxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jeux = DB::table('jeuxes')
        // On y join la table categories
        // ->join('categories', 'categories.id', '=', 'producers.category_id')

        // On y join la table consolejeux
        ->join('console_jeux', 'console_jeux.jeux_id', '=', 'jeuxes.id')
        // On y join la table consoles
        ->join('consoles', 'consoles.id', '=', 'console_jeux.console_id')
        // On sélectionne les colonnes du consoles et on les renommes
        ->select('jeuxes.*', 'consoles.nomConsole as nom_console')

        // On récupère sous forme de tableau
        ->get()
        // On le transforme en tableau PHP
        ->toArray();

    // On retourne les informations des utilisateurs en JSON
    return response()->json([
        'status' => 'Success',
        'data' => $jeux,
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomJeux' => 'required|max:100',
            'categorieJeux' => 'required|max:100',
        ]);

        $jeux = Jeux::create([
            'nomJeux' => $request->nomJeux,
            'categorieJeux' => $request->categorieJeux,
            'console_id'=> $request->console_id,
        ]);

        $consoleJeuxIds[] = $request->console_id;
        // Cette condition vérifie si le tableau $consoleJeuxId n'est pas vide avant de poursuivre le traitement.
        //  Cela permet d'éviter d'exécuter le code inutilement si aucun jeux n'a été envoyé dans la requête.        
        if (!empty($consoleJeuxIds)) {
            // Cette boucle foreach itère sur chaque ID de jeux présent dans le tableau $consoleJeuxId.
            foreach ($consoleJeuxIds as $consoleId) {
                // Cette ligne de code récupère le modèle jeux correspondant à l'ID du jeux de la boucle en utilisant la méthode find().
                //  Cette méthode recherche un enregistrement dans la table jeux qui a l'ID spécifié et renvoie un objet jeux correspondant.
                $console = Console::find($consoleId);
                // Cette ligne de code utilise la méthode attach() sur la relation ManyToMany entre Console et jeux pour ajouter le jeux
                //  récupéré précédemment au producteur que vous voulez mettre à jour.
                $jeux->console()->attach($jeux);
            }
        }
        
        // On retourne les informations du nouveau producteur en JSON
        return response()->json([
            'status' => 'Success',
            'data' => $jeux,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Jeux $jeux)
    {
        // On retourne les informations du producteur en JSON
        return response()->json($jeux);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jeux $jeux)
    {
        $this->validate($request, [
            'nomJeux' => 'required|max:100',
            'categorieJeux' => 'required|max:100',

        ]);

        $jeux->update([
            'nomJeux' => $request->nomJeux,
            'categorieJeux' => $request->categorieJeux,
            'console_id' => $request->console_id
        ]);

        $updateConsoleId = array();

        // // table pivot label_producer // //

        // récupèration des identifiants des modèles Label à partir de la requête HTTP : $consoleJeuxId= $request->label_id;.
        $consoleJeuxId= $request->jeux_id;
        // on vérifie que le tableau $consoleJeuxId n'est pas vide,
        if (!empty($consoleJeuxId)) {
            // puis pour chaque identifiant dans le tableau, on récupère le modèle Jeux correspondant en utilisant la méthode find() 
            for ($i = 0; $i < count($consoleJeuxId); $i++) {
                $jeux = Jeux::find($consoleJeuxId[$i]);
                // on ajoute son identifiant au tableau $updateConsoleId en utilisant la fonction array_push().
                array_push($updateConsoleId, $jeux->id);
            }
            // on appelle la méthode sync() sur la relation console du modèle Jeux en passant le tableau $updateConsoleId comme argument,
            //  ce qui mettra à jour les relations en supprimant toutes les entrées pivot existantes et
            //  en insérant de nouvelles entrées pour les identifiants de modèles jeux fournis.
            $jeux->label()->sync($updateConsoleId);
        }



        return response()->json([
            'status' => 'Mise à jour avec succèss',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jeux $jeux)
    {
         // On supprime l'utilisateur
         $jeux->delete();
         // On retourne la réponse JSON
         return response()->json([
             'status' => 'Supprimer avec succès'
         ]);
    }
}
