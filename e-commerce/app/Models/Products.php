<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
    ];

    // Relationships
    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'product_id');
    }
}
