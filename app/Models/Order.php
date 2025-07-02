<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_number',
        'total_price',
        'payment_method',
        'status',
        'paid_at',
        'payment_token', // Pastikan ini juga ada jika Anda mengikuti panduan Midtrans
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    // ▼▼▼ TAMBAHKAN PROPERTI INI ▼▼▼
    protected $casts = [
        'paid_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    // ▲▲▲ SAMPAI SINI ▲▲▲

    /**
     * Mendefinisikan relasi ke detail pesanan.
     */
    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
