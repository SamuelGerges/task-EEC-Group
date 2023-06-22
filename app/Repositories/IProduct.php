<?php

namespace App\Repositories;

interface IProduct
{
    public function getAllProducts($searchProduct);
    public function create($data);
    public function update($data);

    public function delete($productId);

    public function getProductDetails($productId);

    public function getProductById($productId);



}
