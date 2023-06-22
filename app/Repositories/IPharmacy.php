<?php

namespace App\Repositories;

interface IPharmacy
{
    public function getAllPharmacies($searchPharmacy);

    public function create($data);

    public function getPharmacyById($pharmacyId);
    public function update($data);
    public function delete($pharmacyId);

    public function showProductsByPharmacyId($pharmacyId);


}
