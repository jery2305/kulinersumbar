<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'nama', 'alamat', 'telepon', 'pembayaran', 'status', 'resi'
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
}
