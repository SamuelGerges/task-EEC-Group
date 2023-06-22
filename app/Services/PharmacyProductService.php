<?php

namespace App\Services;

use App\Helpers\ImgHelper;
use App\Helpers\TransformHelper;
use App\Http\Requests\PharmacyProductRequest;
use App\Repositories\IPharmacyProduct;
use Illuminate\Http\Request;

class PharmacyProductService
{

    public $pharmacyProductRepositry;

    public function __construct(IPharmacyProduct $pharmacyProductRepositry)
    {
        $this->pharmacyProductRepositry = $pharmacyProductRepositry;
    }

    public function createPharmacyProduct($data)
    {
        $created = $this->pharmacyProductRepositry->create($data);
        return [
            'message'  => 'Created Successfully',
            'product' => $created,
        ];
    }


    public function getProductInPharmacyById(int $pharmacyProductId)
    {
        $product = $this->pharmacyProductRepositry->getProductInPharmacyById($pharmacyProductId);
        return [
            'message'  => 'Selected Successfully',
            'product' => $product,
        ];
    }

    public function updateProduct($data)
    {
        $product = $this->pharmacyProductRepositry->getProductInPharmacyById($data['id']);

        if (!is_object($product)) {
            return [
                'error' => 'Product not found',
            ];
        }
        $updatedProduct = $this->pharmacyProductRepositry->update($data);

        return [
            'message'  => 'Updated Successfully',
            'product' => $product,

        ];
    }

    public function deletePharmacyProduct(int $idInPharmacyProduct)
    {
        $product = $this->pharmacyProductRepositry->getProductInPharmacyById($idInPharmacyProduct);

        if (!is_object($product)) {
            return [
                'error' => 'Product not found',
            ];
        }

        $deletedProduct = $this->pharmacyProductRepositry->delete($idInPharmacyProduct);

        if ($deletedProduct == 0) {
            return [
                'error' => "Failed Deleted"
            ];
        }
        return [
            'message' => 'Deleted Successfully',

        ];
    }

    public function searchPharmacyProduct($data)
    {
        $products = $this->pharmacyProductRepositry->searchProduct($data);
        return [
            'message'  => 'Selected Successfully',
            'products' => $products,
        ];
    }

    public function getCheapestProductInPharmacies(int $productId)
    {
        $products = $this->pharmacyProductRepositry->getCheapestProductInPharmacies($productId)->toArray();
        return [
            'products' => $products,
            'message'  => "succeed in getting the cheapest products in the  five pharmacies"
        ];
    }
}
