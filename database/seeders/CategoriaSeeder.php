<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'Desarrollo Web',
            'Diseño Gráfico',
            'Marketing Digital',
            'Redacción y Traducción',
            'Programación Móvil',
            'Ciencia de Datos',
            'Soporte Administrativo',
            'Ciberseguridad'
        ];

        foreach ($categorias as $nombre) {
            Categoria::firstOrCreate(['nombre' => $nombre]);
        }
    }
}