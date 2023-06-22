<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\PharmacyRequest;
use App\Services\PharmacyService;

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
        if (isset($_GET['search'])) {
            $searchPharmacy = $_GET['search'];
        }
        $pharmacies = $this->pharmacyService->getAllPharmacies($searchPharmacy);

        return view('site.pharmacies.index', $pharmacies);
    }


    public function create()
    {
        return view('site.pharmacies.create');
    }


    public function store(PharmacyRequest $request)
    {
        $data     = $request->validated();
        $pharmacy = $this->pharmacyService->createPharmacy($data);
        session()->flash('success', $pharmacy['message']);
        return redirect()->route('pharmacies.index');
    }


    public function edit(int $pharmacyId)
    {
        $pharmacy = $this->pharmacyService->getPharmacyById($pharmacyId);
        if (isset($pharmacy['error'])) {
            session()->flash('error', $pharmacy['error']);
            return redirect()->route('pharmacies.index');
        }

        return view('site.pharmacies.edit', $pharmacy);
    }

    public function update(PharmacyRequest $request, int $pharmacyId)
    {

        $data                = $request->validated();
        $data['pharmacy_id'] = $pharmacyId;
        $pharmacy = $this->pharmacyService->updatePharmacy($data);

        if (isset($pharmacy['error'])) {
            session()->flash('error', $pharmacy['error']);
            return redirect()->back();
        }
        session()->flash('success', $pharmacy['message']);
        return redirect()->route('pharmacies.index');

    }

    public function delete(int $pharmacyId)
    {
        $pharmacy = $this->pharmacyService->deletePharmacy($pharmacyId);

        if (isset($pharmacy['error'])) {
            session()->flash('error', $pharmacy['error']);
            return redirect()->back();
        }

        session()->flash('success', $pharmacy['message']);
        return redirect()->back();
    }

    public function showProductsByPharmacyId(int $pharmacyId)
    {
        $products = $this->pharmacyService->getProductsByPharmacyId($pharmacyId);
        return view('site.pharmacies.show_products', $products);
    }




}
