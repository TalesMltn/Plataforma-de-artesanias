<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'precio',
        'stock',
        'imagen',
        'categoria_id',
    ];

    // Relación con categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Generar slug automáticamente al guardar
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($producto) {
            $producto->slug = Str::slug($producto->nombre);
        });

        static::updating(function ($producto) {
            $producto->slug = Str::slug($producto->nombre);
        });
    }
}
