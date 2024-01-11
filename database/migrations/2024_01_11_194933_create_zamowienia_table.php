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
        Schema::create('zamowienia', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('numer_zamowienia')->nullable();
            $table->date('data')->nullable();
            $table->float('ilosc', 12, 3)->nullable();
            $table->foreignId('id_produkt')->constrained('produkty');
            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zamowienia');
    }
};
