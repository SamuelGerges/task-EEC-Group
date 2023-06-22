<?php

namespace App\Console\Commands;

use App\Services\PharmacyProductService;
use Illuminate\Console\Command;

class GetProductById extends Command
{

    public $pharmacyProductService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:search-cheapest {productId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get product in the cheapest 5 pharmacies';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PharmacyProductService $pharmacyProductService)
    {
        parent::__construct();
        $this->pharmacyProductService = $pharmacyProductService;
    }

    /**
     * Execute the console command.
     *
     * @return \Illuminate\Http\JsonResponse|int|object
     */
    public function handle()
    {
        $productId = $this->argument('productId');
        $products  = $this->pharmacyProductService->getCheapestProductInPharmacies($productId);
        echo json_encode($products['products']);

    }
}
