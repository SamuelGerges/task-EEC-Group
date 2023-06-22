<?php

namespace App\Models;

use Database\Factories\PharmacyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyModel extends Model
{
    use HasFactory;

    protected $table      = "pharmacies";
    protected $primaryKey = "pharmacy_id";

    protected $fillable
        = [
            'pharmacy_name',
            'pharmacy_address',
        ];

    protected static function newFactory()
    {
        return new PharmacyFactory();
    }
}
