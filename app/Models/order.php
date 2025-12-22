<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'invoice_number',
        'gross_amount',
        'status',
    ];
    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order_details():HasMany
    {
        return $this->hasMany(order_details::class);
    }

    public function payments():HasMany
    {
        return $this->hasMany(payments::class);
    }
}
