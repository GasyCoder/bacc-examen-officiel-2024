<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;

class CandidatController extends Controller
{
    /*
     * Recherche résultats du bacc Mahajanga, 2024
    */
   public function search(Request $request)
    {
        $request->validate([
            'matricule' => 'sometimes|numeric',
            'nom' => 'sometimes|string',
        ]);

        $query = Candidat::query();

        if ($request->has('matricule')) {
            $query->where('matricule', $request->matricule);
        } elseif ($request->has('nom')) {
            $query->where('lname', 'LIKE', '%' . $request->nom . '%')
                    ->orWhere('lname', 'LIKE', '%' . $request->nom . '%');
        } else {
            return response()->json(['status' => 400, 'message' => 'Invalid request'], 400);
        }

        $results = $query->paginate(10); // Pagination par 10 résultats

        return response()->json(['status' => 200, 'data' => $results], 200);
    }
}
