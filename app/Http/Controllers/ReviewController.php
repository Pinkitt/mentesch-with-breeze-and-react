<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Új értékelés írása
    public function store(Request $request, Restaurant $restaurant)
    {
        // Adatok validálása
        $validated = $request->validate([
            'review' => 'required|string|min:5|max:1000',
        ]);

        // Új review létrehozása az éppen bejelentkezett felhasználó nevében
        $review = new Review();
        $review->review = $validated['review'];
        $review->user_id = Auth::id();
        $review->restaurant_id = $restaurant->id;
        $review->save();

        return redirect()->back()->with('success', 'Értékelés sikeresen elmentve!');
    }
}
