<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public $timestamps = false;
    public const RUB_KEY = 'RUB';

    protected $guarded = ['id'];

    protected $casts = [
        'key' => \App\Enums\Currency::class,
    ];
}
