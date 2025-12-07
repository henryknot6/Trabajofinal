<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Habilidad;

class HabilidadSeeder extends Seeder
{
    public function run(): void
    {
        $habilidades = [
            'PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js',
            'Photoshop', 'Illustrator', 'Figma',
            'SEO', 'Google Ads', 'Redacción SEO',
            'Python', 'SQL', 'Java', 'Swift', 'Kotlin',
            'Excel Avanzado', 'Inglés', 'Gestión de Proyectos'
        ];

        foreach ($habilidades as $nombre) {
            Habilidad::firstOrCreate(['nombre' => $nombre]);
        }
    }
}