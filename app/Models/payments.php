<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class payments extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentsFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'status',
        'snap_token',
        'payment_date',
    ];
    protected $casts = [
        'payment_date' => 'datetime',
    ];
    public function order() :BelongsTo
    {
        return $this->belongsTo(order::class);
    }
}
