<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigues la convención de Laravel)
    protected $table = 'valoraciones';

    // Campos que se pueden llenar
    protected $fillable = [
        'perfil_id',
        'proyecto_id',
        'emisor_id',
        'puntaje',
        'comentario',
    ];

    // Relación: una valoración pertenece a un perfil (artesano evaluado)
    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }

    // Relación: una valoración puede pertenecer a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    // Relación: una valoración tiene un emisor (perfil del cliente que califica)
    public function emisor()
    {
        return $this->belongsTo(Perfil::class, 'emisor_id');
    }
}