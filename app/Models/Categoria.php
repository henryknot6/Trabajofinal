<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias'; 
    protected $fillable = ['nombre'];

    public function empleos()
    {
        return $this->hasMany(Empleo::class, 'categoria_id');
    }
}