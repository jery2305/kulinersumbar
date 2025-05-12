<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
