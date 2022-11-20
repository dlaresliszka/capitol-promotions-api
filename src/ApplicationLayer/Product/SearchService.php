<?php
namespace App\ApplicationLayer\Product;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\ApplicationLayer\Product\DiscountApplier;
use App\DomainLayer\Search\ProductFilters;
use App\DomainLayer\DTO\ProductDTO;
use App\DomainLayer\DTO\ProductListDTO;
use App\DomainLayer\Models\Product;
use Exception;

use App\DomainLayer\Interfaces\ProductRepositoryInterface;

final class SearchService 
{
    private ProductRepositoryInterface $productRepository;
    private GenerateCriteriaService $criteriaService;

    public function __construct(ProductRepositoryInterface $productRepository, GenerateCriteriaService $criteriaService)
    {
        $this->productRepository = $productRepository;
        $this->criteriaService = $criteriaService;
    }

    public function search(Request $request)
    {
        $criteria = $this->criteriaService->generate($request);
        if (count($criteria) > 0) {
            $products = $this->productRepository->findAllByCriteria($criteria);
        } else {
            $products = $this->productRepository->findAllWithLimit();
        }
        $response = $this->parseResponse($products);
        
        return $response;
    }

    private function parseResponse(array $products)
    {
        return new ProductListDTO(...array_map($this->transformProduct(), $products));
    }

    private function transformProduct(): callable
    {
        return static fn (Product $product) => new ProductDTO(
            $product->getSku(),
            $product->getName(),
            $product->getCategory(),
            DiscountApplier::byProduct($product)
        );
    }

}


