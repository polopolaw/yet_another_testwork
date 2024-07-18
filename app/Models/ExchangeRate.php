<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExchangeRate extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'currency_key' => \App\Enums\Currency::class,
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_key', 'key');
    }
}
