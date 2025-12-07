<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    use HasFactory;

    protected $table = 'habilidades'; 
    protected $fillable = ['nombre'];

    public function empleos()
    {
        return $this->belongsToMany(Empleo::class, 'empleo_habilidad', 'habilidad_id', 'empleo_id');
    }
}