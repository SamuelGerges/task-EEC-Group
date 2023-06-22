<?php

namespace App\Repositories\Implementation;

use App\Models\PharmacyProductModel;
use App\Models\ProductModel;
use App\Repositories\IProduct;
use Illuminate\Support\Facades\DB;

class ProductRepositry implements IProduct
{
    public function getAllProducts($searchProduct = null)
    {
        $response = ProductModel::query()
            ->select(
                'product_id',
                'product_title',
                'product_desc',
                'product_image',
            );

        if ($searchProduct != null) {
            $response = $response->where('product_title', 'like', '%' . $searchProduct . '%');
        }

        $response = $response->latest()
            ->paginate(20);

        return $response;
    }

    public function create($data)
    {
        return ProductModel::query()
            ->create([
                'product_title' => $data['product_title'],
                'product_desc'  => $data['product_desc'],
                'product_image' => $data['product_image'],
            ]);
    }

    public function update($data)
    {
        return ProductModel::query()
            ->where('product_id', '=', $data['product_id'])
            ->limit(1)
            ->update([
                'product_title' => $data['product_title'],
                'product_desc'  => $data['product_desc'],
                'product_image' => $data['product_image'],
            ]);
    }

    public function delete($productId)
    {
        return ProductModel::query()
            ->where('product_id', '=', $productId)
            ->limit(1)
            ->delete();
    }

    public function getProductDetails($productId)
    {
        return PharmacyProductModel::query()
            ->select(
                'pharmacies.pharmacy_name',
                'pharmacies_products.product_price',
                'pharmacies_products.product_quantity',
            )
            ->join('products', 'pharmacies_products.product_id', '=', 'products.product_id')
            ->join('pharmacies', 'pharmacies_products.pharmacy_id', '=', 'pharmacies.pharmacy_id')
            ->where('products.product_id', '=', $productId)
            ->paginate(10);
    }


    public function getProductById($productId)
    {
        return ProductModel::find($productId);
    }





}
