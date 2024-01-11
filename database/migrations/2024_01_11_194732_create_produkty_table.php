<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produkty', function (Blueprint $table) {
            $table->id();
            $table->string('nazwa', 45)->nullable();
            $table->foreignId('id_grupa')->constrained('grupy_produktow');
            $table->float('cena_netto', 10, 2)->nullable();
            $table->integer('vat')->nullable();
            $table->timestamps();
        });


        DB::table('produkty')->insert([
            ['nazwa' => 'Ksiązka 1', 'id_grupa' => 1, 'cena_netto' => 30.00, 'vat' => 23],
            ['nazwa' => 'Ksiązka 2', 'id_grupa' => 1, 'cena_netto' => 40.00, 'vat' => 23],
            ['nazwa' => 'Ksiązka 3', 'id_grupa' => 1, 'cena_netto' => 20.00, 'vat' => 23],
            ['nazwa' => 'Ksiązka 4', 'id_grupa' => 1, 'cena_netto' => 25.00, 'vat' => 23],
            ['nazwa' => 'Ksiązka 5', 'id_grupa' => 1, 'cena_netto' => 20.00, 'vat' => 23],
            ['nazwa' => 'Mydło 1', 'id_grupa' => 2, 'cena_netto' => 15.00, 'vat' => 15],
            ['nazwa' => 'Mydło 2', 'id_grupa' => 2, 'cena_netto' => 16.00, 'vat' => 15],
            ['nazwa' => 'Mydło 3', 'id_grupa' => 2, 'cena_netto' => 20.00, 'vat' => 15],
            ['nazwa' => 'Chleb Mały', 'id_grupa' => 3, 'cena_netto' => 6.00, 'vat' => 8],
            ['nazwa' => 'Chelb duży', 'id_grupa' => 3, 'cena_netto' => 4.00, 'vat' => 8],
            ['nazwa' => 'Jabłka (kg)', 'id_grupa' => 4, 'cena_netto' => 3.00, 'vat' => 8],
            ['nazwa' => 'Banany (kg)', 'id_grupa' => 4, 'cena_netto' => 4.00, 'vat' => 8],
            ['nazwa' => 'Pomidory (kg)', 'id_grupa' => 5, 'cena_netto' => 10.00, 'vat' => 8],
            ['nazwa' => 'Papryka (kg)', 'id_grupa' => 5, 'cena_netto' => 10.00, 'vat' => 8],
            ['nazwa' => 'Ser żółty (kg)', 'id_grupa' => 6, 'cena_netto' => 26.00, 'vat' => 8],
            ['nazwa' => 'Serek homogenizowany', 'id_grupa' => 6, 'cena_netto' => 2.00, 'vat' => 8],
            ['nazwa' => 'Twaróg (kg)', 'id_grupa' => 6, 'cena_netto' => 15.00, 'vat' => 8],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produkty');
    }
};
