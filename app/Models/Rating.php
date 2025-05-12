<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

     use HasFactory;

    // Menambahkan menu_id ke dalam fillable
    protected $fillable = ['rating', 'review', 'menu_id'];

    // atau jika anda menggunakan guarded, Anda bisa menambahkan
    // protected $guarded = [];
}
