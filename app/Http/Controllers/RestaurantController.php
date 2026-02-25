<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('reviews.user')->get();
        
        return response()->json($restaurants);
    }

    public function show(Restaurant $restaurant)
    {
        $restaurant->load('reviews.user');
        
        return response()->json($restaurant);
    }




      //----------------------------------------------//
     //                 Requirements                 //
    //----------------------------------------------//
    public function store(Request $request)
{
    if (!Auth::user()->is_admin) {
        return response()->json(['message' => 'Admin jog szükséges!'], 403);
    }

    $validated = $request->validate([
        'name' => 'required|string|max:255|min:5',
        'address' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB, png/jpg/jpeg     
        //frontenden valami ilyesmit látni: restaurants/abc123xyz.jpg
    ],
    [
        'name.required' => 'Az étterem nevének megadása kötelező!',
        'name.min' => 'Az étterem nevének legalább 5 karakter hosszúnak kell lennie!',
        'name.max' => 'Az étterem neve nem lehet hosszabb 255 karakternél!',
        'address.required' => 'A cím megadása kötelező!',
        'image.max'=> 'A kép maximum 2MB méretű lehet!',
        'image.mimes'=> 'Nem megfelelő képformátum! Támogatott formátumok: png, jpeg, jpeg',
    ]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('restaurants', 'public');
        $validated['image'] = $path;
    }

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('restaurants', 'public');
        $validated['image'] = $path;
    }
    $restaurant = Restaurant::create($validated);

    return response()->json(['message' => 'Étterem létrehozva!','data' => $restaurant], 201);
}




      //----------------------------------------------//
     //                    CRUD                      //
    //----------------------------------------------//

    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255|min:5',
                'address' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ],
            [
                'name.required' => 'Az étterem nevének megadása kötelező!',
                'name.min' => 'Az étterem nevének legalább 5 karakter hosszúnak kell lennie!',
                'name.max' => 'Az étterem neve nem lehet hosszabb 255 karakternél!',
                'address.required' => 'A cím megadása kötelező!',
                'image.max'=> 'A kép maximum 2MB méretű lehet!',
                'image.mimes'=> 'Nem megfelelő képformátum! Támogatott formátumok: png, jpeg, jpeg',
            ]
        );

        $restaurant->update($validated);

        return response()->json(['message' => 'Az étterem adatai sikeresen frissítve!'], 200);
    }

    public function destroy(Restaurant $restaurant)
    {
        if (!Auth::user()->is_admin) {
            return response()->json(['message' => 'Admin jog szükséges!'], 403);
    }

    $restaurant->delete();

    return response()->json(['message' => 'Étterem törölve!'], 200);
}
}