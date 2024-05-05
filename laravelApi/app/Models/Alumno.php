<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'edad', 'correo', 'direccion', 'telefono'
    ];

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
