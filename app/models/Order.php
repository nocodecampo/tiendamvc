<?php

namespace Formacom\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";
    protected $primaryKey = 'order_id';
    protected $fillable = ['customer_id', 'discount'];

    // Relación con Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relación con Products (n to m)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_has_product', 'order_id', 'product_id')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
