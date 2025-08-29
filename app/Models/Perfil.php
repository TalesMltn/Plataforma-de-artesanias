<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfiles';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
        'ubicacion',
        'telefono',
    ];

    // Relación: un perfil pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: un perfil puede tener muchos proyectos (si los tienes)
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    // Relación: un perfil puede recibir muchos mensajes
    public function mensajes()
    {
        return $this->hasMany(Mensaje::class, 'receptor_id');
    }

    // Relación: un perfil tiene valoraciones
    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }
}
