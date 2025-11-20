<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Course;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar de manera masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // agrega aquí otros campos si tu tabla users tiene más columnas
    ];

    /**
     * Los atributos que deben ocultarse en arrays / JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben castearse.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    /**
     * Relación muchos a muchos:
     * Un usuario puede estar en muchos cursos.
     */
    public function courses()
    {
        return $this->belongsToMany(
            Course::class,      // Modelo Course
            'usuario_cursos',   // Tabla pivote
            'user_id',          // FK de usuario en la pivote
            'course_id'         // FK de curso en la pivote
        )->withTimestamps();
    }

    /**
     * Contactos que este usuario agregó.
     * (Mis contactos)
     */
    public function contactos()
    {
        return $this->belongsToMany(
            self::class,        // Relación con el mismo modelo User
            'contactos',        // Tabla pivote
            'usuario_id_1',     // Este usuario
            'usuario_id_2'      // El contacto
        )->withTimestamps();
    }

    /**
     * Usuarios que me tienen agregado como contacto.
     */
    public function contactosDe()
    {
        return $this->belongsToMany(
            self::class,
            'contactos',
            'usuario_id_2',     // Este usuario es el contacto
            'usuario_id_1'      // El que me agregó
        )->withTimestamps();
    }
}