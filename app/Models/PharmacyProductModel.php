<?php

namespace App\Models;

use Database\Factories\PharmacyProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyProductModel extends Model
{
    use HasFactory;
    protected $table = "pharmacies_products";
    protected $primaryKey = "id";

    protected $fillable = [
        'product_id',
        'pharmacy_id',
        'product_quantity',
        'product_price',
    ];

    public $timestamps = false;
    protected static function newFactory()
    {
        return new PharmacyProductFactory();
    }
}
