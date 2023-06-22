<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponsesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PharmacyRequest;
use App\Services\PharmacyService;
use Illuminate\Http\Response;

class PharmacyController extends Controller
{
    public $pharmacyService;

    public function __construct(PharmacyService $pharmacyService)
    {
        $this->pharmacyService = $pharmacyService;
    }

    public function index()
    {
        $searchPharmacy = null;
        if (!empty(request('search'))) {
            $searchPharmacy = request('search');
        }
        $pharmacies = $this->pharmacyService->getAllPharmacies($searchPharmacy);
        return ResponsesHelper::returnData(
            $pharmacies['pharmacies'],
            $pharmacies['message'],
        );
    }

    public function store(PharmacyRequest $request)
    {

        $data        = $request->validated();
        $pharmacyObj = $this->pharmacyService->createPharmacy($data);
        return ResponsesHelper::returnData(
            $pharmacyObj['pharmacyObj'],
            $pharmacyObj['message'],
            Response::HTTP_CREATED
        );

    }

    public function update(PharmacyRequest $request, int $pharmacyId)
    {
        $data                = $request->validated();
        $data['pharmacy_id'] = $pharmacyId;
        $pharmacy = $this->pharmacyService->updatePharmacy($data);

        if(isset($pharmacy['error'])){
            return ResponsesHelper::returnError(
                Response::HTTP_NOT_FOUND,
                $pharmacy['error'],
            );
        }
        return ResponsesHelper::returnSuccessMessage(
            Response::HTTP_OK,
            $pharmacy['message'],
        );

    }

    public function delete(int $pharmacyId)
    {
        $pharmacyObj = $this->pharmacyService->deletePharmacy($pharmacyId);

        if(isset($pharmacyObj['error']))
        {
            return ResponsesHelper::returnError(
                Response::HTTP_OK,
                $pharmacyObj['error']
            );
        }
        return ResponsesHelper::returnSuccessMessage(
            Response::HTTP_OK,
            $pharmacyObj['message']
        );
    }


    public function showProductsByPharmacyId(int $pharmacyId)
    {
        $products = $this->pharmacyService->getProductsByPharmacyId($pharmacyId);
        return ResponsesHelper::returnData(
            $products['products'],
            $products['message'],
        );
    }



}
