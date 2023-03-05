<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("departamento", 100);
            $table->string("localidad", 100);
            $table->string("municipio", 100);
            $table->string("nombre", 250);
            $table->integer("años_activo");
            $table->string("tipo_persona", 100);
            $table->string("tipo_cargo", 100);
            $table->fullText('nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
