<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['review', 'user_id', 'restaurant_id'];

    // Egyes szám, mert csak egy étteremhez tartozik
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    // Egyes szám, mert csak egy felhasználó írta
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}