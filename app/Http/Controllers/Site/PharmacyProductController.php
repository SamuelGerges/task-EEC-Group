<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\PharmacyProductRequest;
use App\Http\Requests\UpdatedPharmacyProductRequest;
use App\Services\PharmacyProductService;

class PharmacyProductController extends Controller
{
    public $pharmacyProductService;

    public function __construct(PharmacyProductService $pharmacyProductService)
    {
        $this->pharmacyProductService = $pharmacyProductService;
    }

    public function addProductToPharmacy(int $id)
    {
        return view('site.pharmacies.addProduct', compact('id'));
    }

    public function searchProductSelect2()
    {
        $data     = [];
        $key      = $_GET['product_name'];
        $products = $this->pharmacyProductService->searchPharmacyProduct($key);

        if (isset($products['products']) && count($products['products']) > 0) {
            foreach ($products['products'] as $product) {
                $data[] = [
                    "id"   => $product->product_id,
                    "text" => $product->product_title
                ];
            }
        }

        $searchedProducts = json_encode($data);
        echo $searchedProducts;
    }

    public function storePharmacyProduct(PharmacyProductRequest $request, int $pharmacyId)
    {
        $data                = $request->validated();
        $data['pharmacy_id'] = $pharmacyId;
        $product             = $this->pharmacyProductService->createPharmacyProduct($data);
        session()->flash('success', $product['message']);
        return redirect()->route('pharmacies.showProductsByPharmacyId', $pharmacyId);
    }



    public function edit(int $productIdInPharmacy)
    {
        $product = $this->pharmacyProductService->getProductInPharmacyById($productIdInPharmacy);

        return view('site.pharmaciesproducts.edit', $product);
    }


    public function update(UpdatedPharmacyProductRequest $request, int $productIdInPharmacy)
    {
        $data = $request->validated();
        $data['id'] = $productIdInPharmacy;

        $updatedProduct = $this->pharmacyProductService->updateProduct($data);

        if(isset($updatedProduct['error']))
        {
            session()->flash('error',$updatedProduct['error']);
            return redirect()->back();
        }
        session()->flash('success',$updatedProduct['message']);
        return redirect()->route('pharmacies.showProductsByPharmacyId', $updatedProduct['product']->pharmacy_id);
    }


    public function delete(int $productId)
    {
        $deletedProduct = $this->pharmacyProductService->deletePharmacyProduct($productId);

        if (isset($deleted['error']))
        {
            session()->flash('error',$deletedProduct['error']);
            return redirect()->back();
        }
        session()->flash('success',$deletedProduct['message']);
        return redirect()->back();
    }

}
