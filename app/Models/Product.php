<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    // Kolom-kolom yang boleh diisi secara massal
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
    ];

    /**
     * Mendefinisikan relasi ke model Category.
     * Satu produk hanya memiliki satu kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
