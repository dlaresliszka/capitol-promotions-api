<?php
namespace App\ApplicationLayer\Product;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;

use App\DomainLayer\Interfaces\ProductRepositoryInterface;
use App\DomainLayer\Enum\ProductFilterEnum;

final class GenerateCriteriaService
{
    const PRICE_FILTER_NAME = 'priceLessThan';

    public function generate(Request $request)
    {
        return $this->getFilters($request);
    }

    public function getFilters($request): array
    {
        $filters = [];
        foreach(ProductFilterEnum::FILTERS as $key => $filterName) {
            
            $value = $this->getValue($filterName, $request) ;
            if (empty($value)) {
                continue;
            }
            
            $filters[] = [
                'name' => $filterName,
                'operator' => $this->getOperator($filterName),
                'value' => $value
            ];
        }
        return $filters;
    }

    private function getValue(string $filterName, $request)
    {
        if ($filterName == 'price') {
            return $request->get(self::PRICE_FILTER_NAME);
        }
        

        if(is_string($request->get($filterName))) {
            return "'{$request->get($filterName)}'";
        }

        return $request->get($filterName);
    }

    private function getOperator(string $filterName): string
    {
        if ($filterName == 'price') {
            return '<=';
        }

        return '=';
    }
}


