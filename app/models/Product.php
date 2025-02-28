<?php

namespace Formacom\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $primaryKey = 'product_id';
    protected $fillable = ['name', 'description', 'stock', 'price'];

    // Relación: Un producto pertenece a una categoría.
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    // Relación: Un producto pertenece a un proveedor.
    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_has_product', 'product_id', 'order_id')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
