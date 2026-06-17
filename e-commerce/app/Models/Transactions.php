<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = ['user_id', 'product_id', 'jumlah', 'total_harga', 'status_pembayaran', 'jenis_pembayaran'];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderUpdate()
    {
        return $this->hasOne(Order_Updates::class, 'transaction_id');
    }
}
