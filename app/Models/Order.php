<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'nama', 'alamat', 'telepon', 'pembayaran', 'status', 'resi', 'total', 'bukti_pembayaran'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Jika masih perlu menghubungkan dengan user melalui relasi lain (misalnya menggunakan sesi)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menu() 
    {
        return $this->belongsTo(Menu::class);
    }
}
