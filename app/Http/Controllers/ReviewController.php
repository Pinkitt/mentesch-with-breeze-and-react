<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate(
        [
            'review' => 'required|string|min:5|max:1000',
        ],
        [
            'review.min'=> 'A véleménynek minimum 5 karakter hosszúnak kell lennie!',
            'review.max'=>'A vélemény maximum 1000 karakter hosszú lehet!',
            'review.required' => 'A vélemény megadása kötelező',
        ]);

        //Új review létrehozása az éppen bejelentkezett felhasználó nevében
        $review = new Review();
        $review->review = $validated['review'];
        $review->user_id = Auth::id();
        $review->restaurant_id = $restaurant->id;
        $review->save();

        return response()->json(['message' => 'Vélemény sikeresen elmentve!', 'data' => $review], 201);
    }


      //----------------------------------------------//
     //                    CRUD                      //
    //----------------------------------------------//

    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            return response()->json(['message' => 'Nincs jogosultságod módosítani ezt a véleményt!'], 403);
        }

        $validated = $request->validate([
            'review' => 'required|string|min:5|max:1000',
        ], [
            'review.min' => 'A véleménynek minimum 5 karakter hosszúnak kell lennie!',
            'review.max' => 'A vélemény maximum 1000 karakter hosszú lehet!',
            'review.required' => 'A vélemény megadása kötelező',
        ]);

        $review->update($validated);

        return response()->json(['message' => 'Vélemény sikeresen frissítve!'], 200);
    }

    public function destroy(Review $review)
{
    if ($review->user_id === Auth::id() || Auth::user()->is_admin) {
        $review->delete();
        return response()->json(['message' => 'Vélemény sikeresen törölve!'], 200);
    }

    return response()->json(['message' => 'Nincs jogosultságod törölni ezt a véleményt!'], 403);
}
}
