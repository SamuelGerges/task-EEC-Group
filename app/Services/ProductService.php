<?php

namespace App\Services;

use App\Helpers\ImgHelper;
use App\Helpers\TransformHelper;
use App\Http\Requests\ProductRequest;
use App\Repositories\IProduct;

class ProductService
{

    public $productRepositry;

    public function __construct(IProduct $productRepositry)
    {
        $this->productRepositry = $productRepositry;
    }

    public function getAllProducts($searchProduct)
    {
        $products = $this->productRepositry->getAllProducts($searchProduct);
        $products = TransformHelper::getImageFullLinkForCollection($products, 'product_image');
        return [
            'message'  => 'Success Fetched',
            'products' => $products,
        ];
    }

    public function createProduct($data,$request)
    {
        if($request->has('product_image'))
        {
            $image = $request->file('product_image');
            $data['product_image'] = ImgHelper::uploadImage('products',$image);
        }

        $productObj = $this->productRepositry->create($data);

        return [
            'message'  => 'Created Successfully',
            'product' => $productObj,
        ];
    }

    public function getProductById($productId)
    {
        $productObj = $this->productRepositry->getProductById($productId);
        $productObj = TransformHelper::getImageFullLinkForObject($productObj,'product_image');

        if (!isset($productObj)) {
            return [
                'error' => 'This product not Found',
            ];
        }

        return [
            'message'     => 'fetched Successfully',
            'productObj'  => $productObj,
        ];

    }
    public function updateProduct($data)
    {
        $productObj = $this->productRepositry->getProductById($data['product_id']);

        if (!isset($productObj)) {
            return [
                'error' => 'This product not Found',
            ];
        }

        $productObjUpdated = $this->productRepositry->update($data);

        if ($productObjUpdated != 1){
            return [
                'error' => 'Updated Failed',
            ];
        }

        return[
            'message'  => 'Updated Successfully',
            'product' => $productObj,
        ];
    }

    public function getProductDetails($productId)
    {
        $product        = $this->productRepositry->getProductById($productId);
        $product        = TransformHelper::getImageFullLinkForObject($product, 'product_image');
        $productDetails = $this->productRepositry->getProductDetails($productId);

        return [
            'message'        => 'Success Fetched',
            'product'        => $product,
            'productDetails' => $productDetails,
        ];
    }



    public function deleteProduct($productId)
    {
        $productObj = $this->productRepositry->getProductById($productId);

        if (!isset($productObj)) {
            return [
                'error' => 'This product not Found',
            ];
        }

        if($productObj->product_image != null)
        {
            unlink($productObj->product_image);
        }
        $productDeleted = $this->productRepositry->delete($productId);

        if ($productDeleted != 1) {
            return [
                'error' => 'Failed Deleted',
            ];
        }
        return [
            'message'  => 'Deleted Successfully',
        ];
    }

}
