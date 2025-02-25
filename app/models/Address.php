<?php

namespace Formacom\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = "address";
    protected $primaryKey = 'address_id';
    protected $fillable = ['street', 'zip_code', 'city', 'country'];

    // Relación: Una dirección pertenece a un cliente.
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    // Relación: Una dirección pertenece a un cliente.
    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
