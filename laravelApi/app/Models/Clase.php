<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'descripcion', 'profesor', 'horario', 'sala'
    ];

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
