<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponsesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $searchProduct = null;
        if (!empty(request('search'))) {
            $searchProduct = request('search');
        }
        $products = $this->productService->getAllProducts($searchProduct);
        return ResponsesHelper::returnData(
            $products['products'],
            $products['message']
        );
    }

    public function getDetailsForProduct($productID)
    {
        $products = $this->productService->getProductDetails($productID);
        return ResponsesHelper::returnData(
            [
                $products['product'],
                $products['productDetails']
            ],
            $products['message'],
        );
    }


    public function store(ProductRequest $request)
    {
        $data       = $request->validated();
        $productObj = $this->productService->createProduct($data, $request);
        return ResponsesHelper::returnData(
            $productObj['product'],
            $productObj['message'],
        );
    }

    public function update(ProductRequest $request, int $productId)
    {
        $data               = $request->validated();
        $data['product_id'] = $productId;
        $productObj         = $this->productService->updateProduct($data, $request);

        if (isset($productObj['error'])) {
            return ResponsesHelper::returnError(
                Response::HTTP_NOT_FOUND,
                $productObj['error'],
            );
        }
        return ResponsesHelper::returnData(
            $productObj['product'],
            $productObj['message'],
        );
    }

    public function delete(int $productId)
    {
        $product= $this->productService->deleteProduct($productId);

        if (isset($product['error'])) {
            return ResponsesHelper::returnError(
                Response::HTTP_NOT_FOUND,
                $product['error'],
            );
        }

        return ResponsesHelper::returnSuccessMessage(
            Response::HTTP_OK,
            $product['message'],
        );
    }



}
