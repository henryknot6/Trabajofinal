<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'rol')) {
                $table->enum('rol', ['freelancer', 'cliente', 'admin'])->default('freelancer')->after('email');
                $table->string('titulo_profesional')->nullable()->after('rol'); // Ej: Desarrollador Backend
                $table->text('biografia')->nullable()->after('titulo_profesional');
            }
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        Schema::create('habilidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        Schema::create('empleos', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Publicador
            $table->foreignId('categoria_id')->constrained('categorias'); // Rubro
            
            $table->string('titulo');
            $table->text('descripcion');
            $table->decimal('presupuesto', 10, 2)->nullable();
            $table->string('ubicacion')->default('Remoto');
            $table->enum('estado', ['abierto', 'cerrado'])->default('abierto');
            
            $table->timestamps();
        });

        Schema::create('empleo_habilidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleo_id')->constrained('empleos')->onDelete('cascade');
            $table->foreignId('habilidad_id')->constrained('habilidades')->onDelete('cascade');
        });

        Schema::create('usuario_habilidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('habilidad_id')->constrained('habilidades')->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('usuario_habilidad');
        Schema::dropIfExists('empleo_habilidad');
        Schema::dropIfExists('empleos');
        Schema::dropIfExists('habilidades');
        Schema::dropIfExists('categorias');
        
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['rol', 'titulo_profesional', 'biografia']);
        });
    }
};