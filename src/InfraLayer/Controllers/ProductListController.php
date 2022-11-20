<?php
namespace App\InfraLayer\Controllers;

use Symfony\Component\HttpFoundation\Request;
use App\ApplicationLayer\Product\SearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Exception;

final class ProductListController extends AbstractController
{
    private $productSearchService;

    public function __construct(SearchService $searchService)
    {
        $this->productSearchService = $searchService;
    }

    public function invoke(Request $request)
    {
        return new JsonResponse($this->productSearchService->search($request)->getProducts());
    }
}


