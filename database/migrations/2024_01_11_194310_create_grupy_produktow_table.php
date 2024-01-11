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
        Schema::create('grupy_produktow', function (Blueprint $table) {
            $table->id();
            $table->string('nazwa', 45)->nullable();
            $table->timestamps();
        });

        DB::table('grupy_produktow')->insert([
            ['nazwa' => 'Książki'],
            ['nazwa' => 'Środki czystości'],
            ['nazwa' => 'Pieczywo'],
            ['nazwa' => 'Owoce'],
            ['nazwa' => 'Warzywa'],
            ['nazwa' => 'Nabiał'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupy_produktow');
    }
};
