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
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();

            // Usuario principal
            $table->unsignedBigInteger('usuario_id_1');

            // Usuario contacto
            $table->unsignedBigInteger('usuario_id_2');

            // Opcional: estado de la solicitud, etc.
            // $table->enum('estado', ['pendiente', 'aceptado', 'bloqueado'])->default('aceptado');

            $table->timestamps();

            // Llaves foráneas
            $table->foreign('usuario_id_1')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('usuario_id_2')
                ->references('id')->on('users')
                ->onDelete('cascade');

            // Evitar duplicados (no repetir la misma relación)
            $table->unique(['usuario_id_1', 'usuario_id_2']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactos');
    }
};