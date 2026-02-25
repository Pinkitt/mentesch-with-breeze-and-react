<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
//use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('reviews.user')->get();
        
        // Itt majd az Inertia fogja renderelni a React komponenst, pl:
        // return Inertia::render('Restaurants/Index', ['restaurants' => $restaurants]);
        return response()->json($restaurants); // Egyelőre JSON-ként visszaadjuk teszteléshez
    }

    // Egy adott étterem lekérdezése
    public function show(Restaurant $restaurant)
    {
        // Betöltjük a hozzá tartozó értékeléseket és azok íróit
        $restaurant->load('reviews.user');
        
        return response()->json($restaurant);
    }
}