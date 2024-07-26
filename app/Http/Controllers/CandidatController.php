<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;

class CandidatController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'matricule' => 'sometimes|string',
            'nom' => 'sometimes|string|min:4',
            ]);

        if ($request->has('matricule')) {
            return $this->searchByMatricule($request->matricule);
        } elseif ($request->has('nom')) {
            return $this->searchByNom($request->nom);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Nom ou matricule non valide'
            ], 400);
        }
    }

    private function searchByMatricule($matricule)
    {
        if (strlen($matricule) < 7) {
            return response()->json([
                'status' => 400,
                'message' => 'Numero invalide ou trop court'
            ], 400);
        }

        $candidat = Candidat::where('matricule', $matricule)->first();

            // Si le candidat n'existe pas
        if (!$candidat) {
            return response()->json([
                'status' => 200,
                'message' => 'Numero non trouve'
            ], 404);
        }

        if (!$candidat->admis) {
            return response()->json([
                'status' => 200,
                'message' => 'Numero non admis'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Numero admis',
            'data' => $this->formatCandidat($candidat)
        ], 200);
    }

    private function searchByNom($nom)
    {
        $candidats = Candidat::where('fname', 'LIKE', '%' . $nom . '%')
                             ->orWhere('lname', 'LIKE', '%' . $nom . '%')
                             ->paginate(20);

        if ($candidats->isEmpty()) {
            return response()->json([
                'status' => 200,
                'message' => 'Nom non trouve ou n\'existe pas'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $candidats->map(function ($candidat) {
                return $this->formatCandidat($candidat);
            })
        ], 200);
    }

    private function formatCandidat($candidat)
    {
        return [
            'nom' => trim($candidat->fname . ' ' . $candidat->lname),
            'centre' => $candidat->center,
            'mention' => $candidat->mention ?? '-',
            'serie' => $candidat->serie,
            'numInscription' => $candidat->matricule,
            'decision' => $candidat->admis ? 'admis' : 'non-admis'
        ];
    }
}