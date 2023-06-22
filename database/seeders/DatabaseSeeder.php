<?php

namespace Database\Seeders;

use App\Models\PharmacyModel;
use App\Models\PharmacyProductModel;
use App\Models\ProductModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         ProductModel::factory(50000)->create();
         PharmacyModel::factory(20000)->create();
         PharmacyProductModel::factory(400)->create();
    }
}
