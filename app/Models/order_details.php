<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    /** @use HasFactory<\Database\Factories\OrderDetailsFactory> */
    use HasFactory;
    public function order(){
        return $this->belongsTo(order::class);
    }
    public function Product(){
        return $this->belongsTo(Product::class);
    }
}
