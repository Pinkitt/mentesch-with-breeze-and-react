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
        
        $userAllergens = Auth::check() ? Auth::user()->allergens->pluck('id') : []; 

        return response()->json([
            'all_allergens' => $allergens,
            'user_has' => $userAllergens
        ]);
    }

    public function updateMyAllergens(Request $request)
    {
        $request->validate([
            'allergen_ids' => 'array',
            'allergen_ids.*' => 'exists:allergens,id'
        ]);

        $user = Auth::user();
        $user->allergens()->sync($request->allergen_ids);

        return response()->json(['message' => 'Allergének sikeresen frissítve!'], 200);
    }




      //----------------------------------------------//
     //                 Requirements                 //
    //----------------------------------------------//
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:50|min:3',
                'desc' => 'string|max:255',
                'replist'=> 'string|max:300',
            ],
            [
                'name.required' => 'Az allergén nevének megadása kötelező!',
                'name.min' => 'Az allergén nevének legalább 3 karakter hosszúnak kell lennie!',
                'name.max' => 'Az allergén neve nem lehet hosszabb 50 karakternél!',
                'desc.max' => 'Az allergén leírása maximum 255 karakter lehet!',
                'replist.max'=> 'Az alternatívalista maximum 300 karakter lehet!',
            ]
        );

        $allergen = Allergen::create($validated);

        return response()->json(['message' => 'Sikeresen létrehozva!', 'data' => $allergen], 201);
    }




      //----------------------------------------------//
     //                    CRUD                      //
    //----------------------------------------------//

    public function update(Request $request, Allergen $allergen)
    {
         $validated = $request->validate(
            [
                'name' => 'required|string|max:50|min:3',
                'desc' => 'string|max:255',
                'replist'=> 'string|max:300',
            ],
            [
                'name.required' => 'Az allergén nevének megadása kötelező!',
                'name.min' => 'Az allergén nevének legalább 3 karakter hosszúnak kell lennie!',
                'name.max' => 'Az allergén neve nem lehet hosszabb 50 karakternél!',
                'desc.max' => 'Az allergén leírása maximum 255 karakter lehet!',
                'replist.max'=> 'Az alternatívalista maximum 300 karakter lehet!',
            ]
        );

        $allergen->update($validated);

        return response()->json(['message' => 'Módosítások sikeresen elmentve!'], 200);
    }

    public function destroy(Allergen $allergen)
    {
        if (Auth::user()->is_admin === false) {
            return response()->json(['message' => 'Admin jog szükséges!'], 403);
        }

        $allergen->delete();
        
        return response()->json(['message' => 'Allergén sikeresen törölve!'], 200);
    }
}