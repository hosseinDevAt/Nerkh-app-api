<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gold_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('price');
            $table->date('market_date'); // <--- این را حتماً اضافه کن (تاریخ شمسی یا میلادی روز)
            $table->string('type')->default('gold_18'); // نوع طلا (مثلاً ۱۸ عیار یا سکه)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gold_prices');
    }
};
