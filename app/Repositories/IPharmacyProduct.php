<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface IPharmacyProduct
{

    public function create($data);

    public function update($data);
    public function delete($productId);

    public function getProductInPharmacyById($idInPharmacyProduct);

    public function searchProduct($data);

    public function getCheapestProductInPharmacies($productId) : Collection;


}
