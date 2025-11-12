<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();

            // FK al usuario dueño de la transacción
            $table->foreignId('usuario_id')
                  ->constrained('users')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            // Monto: positivo = ingreso, negativo = retiro
            // Usa decimal para dinero; ajusta precisión/escala si lo requieres.
            $table->decimal('monto', 12, 2);

            // Descripción del movimiento
            $table->string('descripcion', 255);

            // (Opcional) referencia externa (p.ej. id de pago, transferencia, etc.)
            $table->string('referencia')->nullable();

            // (Opcional) categoría simple
            $table->string('categoria')->nullable();

            $table->timestamps();

            // Índices útiles para informes
            $table->index(['usuario_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
