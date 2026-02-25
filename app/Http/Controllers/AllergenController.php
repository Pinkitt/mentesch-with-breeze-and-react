<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllergenController extends Controller
{
    public function index()
    {
        $allergens = Allergen::all();
        // A bejelentkezett felhasználó már kiválasztott allergéneinek ID-jai
        $userAllergens = Auth::user()->allergens->pluck('id'); 

        return response()->json([
            'all_allergens' => $allergens,
            'user_has' => $userAllergens
        ]);
    }

    public function updateMyAllergens(Request $request)
    {
        $request->validate([
            'allergen_ids' => 'array', // Tömbben várjuk az ID-kat a frontendről
            'allergen_ids.*' => 'exists:allergens,id'
        ]);

        $user = Auth::user();

        //sync() -> letörli a régieket a kapcsolótábláról, és felteszi az újakat
        $user->allergens()->sync($request->allergen_ids);

        return redirect()->back()->with('success', 'Allergénlista frissítve!');
    }
}