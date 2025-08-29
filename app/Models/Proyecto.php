<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigues la convención de Laravel)
    protected $table = 'proyectos';

    // Campos que se pueden llenar
    protected $fillable = [
        'perfil_id',
        'titulo',
        'descripcion',
        'presupuesto',
        'estado',
    ];

    // Relación: un proyecto pertenece a un perfil (el cliente que lo publica)
    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }

    // Relación: un proyecto puede tener muchas valoraciones
    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }

    // Relación: un proyecto puede tener muchos mensajes
    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }
}