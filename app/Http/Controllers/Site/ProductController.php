<?php

namespace App\Http\Controllers\Site;

use App\Helpers\ImgHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repositories\Implementation\ProductRepositry;
use App\Services\ProductService;
use Illuminate\Http\Request;

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
        if (isset($_GET['search'])) {
            $searchProduct = $_GET['search'];
        }
        $products = $this->productService->getAllProducts($searchProduct);
        return view('site.products.index', $products);
    }

    public function getDetailsForProduct($productID)
    {
        $products = $this->productService->getProductDetails($productID);
        return view('site.products.show_product_details',$products);
    }

    public function create()
    {
        return view('site.products.create');
    }

    public function store(ProductRequest $request)
    {
        $data       = $request->validated();
        $productObj = $this->productService->createProduct($data, $request);
        session()->flash('success', $productObj['message']);
        return redirect()->route('products.index');
    }

    public function edit(int $productId)
    {
        $product = $this->productService->getProductById($productId);

        if (isset($productObj['error'])) {
            session()->flash('error', $productObj['error']);
            return redirect()->route('products.index');
        }

        return view('site.products.edit', $product);
    }

    public function update(ProductRequest $request, int $productId)
    {
        $data               = $request->validated();
        $data['product_id'] = $productId;
        $product            = $this->productService->updateProduct($data, $request);

        if (isset($product['error'])) {
            session()->flash('error', $product['error']);
            return redirect()->back();
        }
        session()->flash('success', $product['message']);
        return redirect()->route('products.index');
    }

    public function delete(int $productId)
    {
        $product= $this->productService->deleteProduct($productId);

        if (isset($product['error'])) {
            session()->flash('error', $product['error']);
            return redirect()->back();
        }

        session()->flash('success', $product['message']);
        return redirect()->back();
    }




}
