<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
    protected $fillable = ['name', 'desc', 'replist'];

    // Többes szám, mert több felhasználónak is lehet ez az allergiája
    public function users()
    {
        return $this->belongsToMany(User::class, 'allergenlists');
    }
}