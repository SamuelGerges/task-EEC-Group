<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponsesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PharmacyProductRequest;
use App\Http\Requests\UpdatedPharmacyProductRequest;
use App\Services\PharmacyProductService;
use Illuminate\Http\Response;

class PharmacyProductController extends Controller
{
    public $pharmacyProductService;

    public function __construct(PharmacyProductService $pharmacyProductService)
    {
        $this->pharmacyProductService = $pharmacyProductService;
    }

    public function getDataSelect2()
    {

        if (!isset($_GET['product_title'])) {
            return ResponsesHelper::returnError(
                Response::HTTP_BAD_REQUEST,
                "Please enter product name to search for it"
            );
        }
        $key      = $_GET['product_title'];
        $products = $this->pharmacyProductService->searchPharmacyProduct($key);
        $data     = [];

        if (isset($products['products']) && count($products['products']) > 0) {
            foreach ($products['products'] as $product) {
                $data[] = [
                    "product_id"    => $product->product_id,
                    "product_title" => $product->product_title
                ];
            }
        } else {
            $data = ["msg" => "No data founded"];
        }
        return ResponsesHelper::returnData($data);
    }

    public function storePharmacyProduct(PharmacyProductRequest $request, int $pharmacyId)
    {
        $data                = $request->validated();
        $data['pharmacy_id'] = $pharmacyId;
        $product             = $this->pharmacyProductService->createPharmacyProduct($data);
        return ResponsesHelper::returnData(
            $product['product'],
            $product['message'],
        );
    }

    public function update(UpdatedPharmacyProductRequest $request, int $productIdInPharmacy)
    {
        $data = $request->validated();
        $data['id'] = $productIdInPharmacy;
        $updatedProduct = $this->pharmacyProductService->updateProduct($data);

        if(isset($updatedProduct['error']))
        {
            return ResponsesHelper::returnError(
                Response::HTTP_CONFLICT,
                $updatedProduct['error']
            );
        }

        return ResponsesHelper::returnSuccessMessage(
            Response::HTTP_OK,
            $updatedProduct['message'],
        );
    }

    public function delete(int $productId)
    {
        $deletedProduct = $this->pharmacyProductService->deletePharmacyProduct($productId);

        if (isset($deletedProduct['error'])) {
            return ResponsesHelper::returnError(
                Response::HTTP_CONFLICT,
                $deletedProduct['error']
            );
        }

        return ResponsesHelper::returnSuccessMessage(
            Response::HTTP_OK,
            $deletedProduct['message'],
        );
    }
}
