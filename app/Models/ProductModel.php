<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $primaryKey = "product_id";

    protected $fillable = [
        'product_title',
        'product_desc',
        'product_image',
    ];

    protected static function newFactory()
    {
        return new ProductFactory();
    }
}
