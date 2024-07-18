<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bills', static function (Blueprint $table) {
            $table->id();
            $table->decimal('cost');
            $table->date('date');
            $table->string('currency_key', 10);


            $table->index(['currency_key', 'date']);
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('bills');
        }
    }
};
