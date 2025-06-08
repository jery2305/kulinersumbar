<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'review', 'menu_id'];

    /**
     * Relasi ke menu yang diberi rating.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
