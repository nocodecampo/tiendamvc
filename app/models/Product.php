<?php

namespace Formacom\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $primaryKey = 'product_id';
    protected $fillable = ['name', 'description', 'stock', 'price'];
}
