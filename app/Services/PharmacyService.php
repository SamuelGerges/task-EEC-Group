<?php

namespace App\Services;

use App\Helpers\TransformHelper;
use App\Repositories\IPharmacy;

class PharmacyService
{
    public $pharmacyRepositry;

    public function __construct(IPharmacy $pharmacyRepositry)
    {
        $this->pharmacyRepositry = $pharmacyRepositry;
    }

    public function getAllPharmacies($searchPharmacy)
    {
        $pharmacies = $this->pharmacyRepositry->getAllPharmacies($searchPharmacy);
        return [
            'message'    => 'Success Fetched',
            'pharmacies' => $pharmacies,
        ];
    }

    public function createPharmacy($data)
    {
        $pharmacyObj = $this->pharmacyRepositry->create($data);
        return [
            'message'     => 'Created Successfully',
            'pharmacyObj' => $pharmacyObj,
        ];
    }

    public function getPharmacyById($pharmacyId)
    {
        $pharmacyObj = $this->pharmacyRepositry->getPharmacyById($pharmacyId);
        if (!isset($pharmacyObj)) {
            return [
                'error' => 'This Pharmacy not Found',
            ];
        }

        return [
            'message'     => 'fetched Successfully',
            'pharmacyObj' => $pharmacyObj,
        ];

    }

    public function updatePharmacy($data)
    {
        $pharmacyObj = $this->pharmacyRepositry->getPharmacyById($data['pharmacy_id']);

        if (!isset($pharmacyObj)) {
            return [
                'error' => 'This Pharmacy not Found',
            ];
        }

        $pharmacyObjUpdated = $this->pharmacyRepositry->update($data);

        if ($pharmacyObjUpdated == 0){
            return [
                'error' => 'Updated Failed',
            ];
        }

        return [
            'message'     => 'Updated Successfully',
        ];

    }

    public function deletePharmacy($pharmacyId)
    {
        $pharmacyObj = $this->pharmacyRepositry->getPharmacyById($pharmacyId);

        if (!isset($pharmacyObj)) {
            return [
                'error' => 'This Pharmacy not Found',
            ];
        }

        $deletedPharmacy = $this->pharmacyRepositry->delete($pharmacyId);

        if ($deletedPharmacy == 0) {
            return [
                'error' => 'Failed Deleted',
            ];
        }

        return [
            'message'  => 'Deleted Successfully',
        ];
    }

    public function getProductsByPharmacyId($pharmacyId)
    {
        $products = $this->pharmacyRepositry->showProductsByPharmacyId($pharmacyId);
        $products = TransformHelper::getImageFullLinkForCollection($products, 'product_image');

        return [
            'message'  => 'Success Fetched',
            'products' => $products,
        ];
    }




}
