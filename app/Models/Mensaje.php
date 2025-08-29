<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigues la convención de Laravel)
    protected $table = 'mensajes';

    // Campos que se pueden llenar
    protected $fillable = [
        'emisor_id',
        'receptor_id',
        'proyecto_id',
        'contenido',
        'leido',
    ];

    // Relación: un mensaje pertenece a un emisor (perfil)
    public function emisor()
    {
        return $this->belongsTo(Perfil::class, 'emisor_id');
    }

    // Relación: un mensaje pertenece a un receptor (perfil)
    public function receptor()
    {
        return $this->belongsTo(Perfil::class, 'receptor_id');
    }

    // Relación: un mensaje puede pertenecer a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}   