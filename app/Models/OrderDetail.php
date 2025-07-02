<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- PENTING: Import class BelongsTo

class OrderDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    /**
     * Mendefinisikan relasi ke model Product.
     * Satu detail pesanan memiliki satu produk.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Mendefinisikan relasi ke model Order.
     * Satu detail pesanan milik satu pesanan.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
