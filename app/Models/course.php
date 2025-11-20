<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Nombre de la tabla (por si acaso)
    protected $table = 'courses';

    // Campos que se pueden llenar en create() / update()
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relación muchos a muchos con User.
     * Un curso puede tener muchos usuarios.
     */
    public function users()
    {
        return $this->belongsToMany(
            User::class,        // Modelo relacionado
            'usuario_cursos',   // Tabla pivote
            'course_id',        // FK en pivote que apunta a courses
            'user_id'           // FK en pivote que apunta a users
        )->withTimestamps();
    }
}