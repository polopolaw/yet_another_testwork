<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exchange_rates', static function (Blueprint $table) {
            $table->id();
            $table->string('currency_key');
            $table->decimal('rate');
            $table->date('date');

            $table->unique(['currency_key', 'date']);
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('exchange_rates');
        }
    }
};
