<?php

namespace Formacom\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = "provider";
    protected $primaryKey = 'provider_id';

    // Relación: Un proveedor puede tener muchas direcciones.
    public function addresses()
    {
        // Se asume que en la tabla address existe la columna 'provider_id' como clave foránea.
        return $this->hasMany(Address::class, 'provider_id');
    }

     // Relación: Un proveedor puede tener muchos teléfonos.
     public function phones()
     {
         // Se asume que en la tabla address existe la columna 'provider_id' como clave foránea.
         return $this->hasMany(Phone::class, 'provider_id');
     }
}
