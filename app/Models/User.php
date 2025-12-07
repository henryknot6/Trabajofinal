<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
        'titulo_profesional',
        'biografia',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relaciones del Proyecto
    public function empleos()
    {
        return $this->hasMany(Empleo::class, 'user_id');
    }
    
    public function habilidades()
    {
        return $this->belongsToMany(Habilidad::class, 'usuario_habilidad', 'user_id', 'habilidad_id');
    }
    public function postulaciones()
{
    return $this->belongsToMany(Empleo::class, 'postulaciones', 'user_id', 'empleo_id')
                ->withTimestamps();
}
}