<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Updates extends Model
{
    protected $fillable = ['transaction_id', 'status'];

    // Relationships
    public function transaction()
    {
        return $this->belongsTo(Transactions::class, 'transaction_id');
    }
}
