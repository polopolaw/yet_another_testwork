<?php

namespace App\Models;

use App\Collections\BillCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_key', 'key');
    }

    protected $casts = [
        'currency_key' => \App\Enums\Currency::class,
    ];


}
