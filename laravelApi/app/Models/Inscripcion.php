<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';
    use HasFactory;

    protected $fillable = [
        'alumno_id', 'clase_id', 'materia_id', 'estado_pago'
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function clase()
    {
        return $this->belongsTo(Clase::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}
