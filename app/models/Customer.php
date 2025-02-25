<?php

namespace Formacom\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customer";
    protected $primaryKey = 'customer_id';

    // Relación: Un cliente puede tener muchas direcciones.
    public function addresses()
    {
        // Se asume que en la tabla address existe la columna 'customer_id' como clave foránea.
        return $this->hasMany(Address::class, 'customer_id');
    }

    // Relación: Un cliente puede tener muchos teléfonos.
    public function phones()
    {
        // Se asume que en la tabla address existe la columna 'customer_id' como clave foránea.
        return $this->hasMany(Address::class, 'customer_id');
    }
}
