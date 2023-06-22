<?php

namespace App\Repositories\Implementation;

use App\Models\PharmacyProductModel;
use App\Models\ProductModel;
use App\Repositories\IPharmacyProduct;
use Illuminate\Support\Collection;

class PharmacyProductRepositry implements IPharmacyProduct
{

    public function create($data)
    {
        return PharmacyProductModel::query()
            ->create([
                'pharmacy_id'      => $data['pharmacy_id'],
                'product_id'       => $data['product_id'],
                'product_price'    => $data['product_price'],
                'product_quantity' => $data['product_quantity'],
            ]);
    }

    public function update($data)
    {
        return PharmacyProductModel::query()
            ->where('id', '=', $data['id'])
            ->limit(1)
            ->update([
                'product_price'    => $data['product_price'],
                'product_quantity' => $data['product_quantity'],
            ]);
    }

    public function delete($id)
    {
        return PharmacyProductModel::query()
            ->where('id', '=', $id)
            ->limit(1)
            ->delete();
    }

    public function getProductInPharmacyById($idInPharmacyProduct)
    {
        return PharmacyProductModel::find($idInPharmacyProduct);
    }

    public function searchProduct($data)
    {
        return ProductModel::query()
            ->select('product_id', 'product_title')
            ->where('product_title', 'like', '%' . $data . '%')
            ->limit(10)
            ->get();
    }

    public function getCheapestProductInPharmacies($productId) :Collection
    {
        return PharmacyProductModel::query()
            ->select(
                'pharmacies_products.pharmacy_id',
                'pharmacies.pharmacy_name',
                'pharmacies_products.product_price'
            )
            ->join('pharmacies', 'pharmacies_products.pharmacy_id', '=', 'pharmacies.pharmacy_id')
            ->where('pharmacies_products.product_id', '=', $productId)
            ->orderBy('pharmacies_products.product_price')
            ->limit(5)
            ->get();
    }



}
