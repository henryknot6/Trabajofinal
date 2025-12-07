<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleo extends Model
{
    use HasFactory;

    protected $table = 'empleos'; 

    protected $fillable = [
        'user_id',
        'categoria_id',
        'titulo',
        'descripcion',
        'presupuesto',
        'ubicacion',
        'estado'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function publicador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function habilidades()
    {
        return $this->belongsToMany(Habilidad::class, 'empleo_habilidad', 'empleo_id', 'habilidad_id');
    }
    public function candidatos()
{
    return $this->belongsToMany(User::class, 'postulaciones', 'empleo_id', 'user_id')
                ->withTimestamps();
}
}