<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'address', 'image'];

    // Többes szám, mert egy étteremnek sok értékelése van
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}