<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'price', 'description', 'image'];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
