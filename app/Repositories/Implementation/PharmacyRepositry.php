<?php

namespace App\Repositories\Implementation;

use App\Models\PharmacyModel;
use App\Models\ProductModel;
use App\Repositories\IPharmacy;
use Illuminate\Support\Facades\DB;

class PharmacyRepositry implements IPharmacy
{
    public function getAllPharmacies($searchPharmacy = null)
    {
        $response = PharmacyModel::query()
            ->select(
                'pharmacy_id',
                'pharmacy_name',
                'pharmacy_address',
            );
        if ($searchPharmacy != null) {
            $response = $response->where('pharmacy_name', 'like', '%' . $searchPharmacy . '%');
        }
        $response = $response->latest()
            ->paginate(20);

        return $response;
    }

    public function create($data)
    {
        return PharmacyModel::query()
            ->create([
                'pharmacy_name'    => $data['pharmacy_name'],
                'pharmacy_address' => $data['pharmacy_address'],
            ]);
    }

    public function getPharmacyById($pharmacyId)
    {
        return PharmacyModel::query()
            ->find($pharmacyId);
    }

    public function update($data)
    {
        return PharmacyModel::query()
            ->where('pharmacy_id', '=', $data['pharmacy_id'])
            ->limit(1)
            ->update([
                'pharmacy_name'    => $data['pharmacy_name'],
                'pharmacy_address' => $data['pharmacy_address'],
            ]);
    }

    public function delete($pharmacyId)
    {
        return PharmacyModel::query()
            ->where('pharmacy_id', '=', $pharmacyId)
            ->limit(1)
            ->delete();
    }


    public function showProductsByPharmacyId($pharmacyId)
    {
        return PharmacyModel::query()
            ->select(
                'pharmacies_products.id',
                'products.product_id',
                'products.product_title',
                'products.product_desc',
                'products.product_image',
                'pharmacies_products.product_price',
                'pharmacies_products.product_quantity',
            )
            ->join('pharmacies_products', 'pharmacies.pharmacy_id', '=', 'pharmacies_products.pharmacy_id')
            ->join('products', 'pharmacies_products.product_id', '=', 'products.product_id')
            ->where('pharmacies.pharmacy_id', '=', $pharmacyId)
            ->paginate(10);
    }


}
