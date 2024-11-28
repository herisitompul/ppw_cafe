<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status'
    ];

    // Menghapus kolom total_price dari $fillable

    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship dengan OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Method untuk menghitung total harga secara dinamis
    public function getTotalPriceAttribute()
    {
        return $this->orderItems->sum('total_harga');
    }

    // Tambahkan atribut yang akan di-append ke JSON
    protected $appends = ['total_price'];
}
