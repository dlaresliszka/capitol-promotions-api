<?php
namespace App\Tests\DomainLayer;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use App\DomainLayer\Enum\DiscountEnum;
use App\DomainLayer\Models\Product;
use App\DomainLayer\ValueObjects\Price;
use App\ApplicationLayer\Product\DiscountApplier;
use App\DomainLayer\DTO\ProductDTO;

class ProductTest extends TestCase
{
    public function test_product_structure()
    {
        $product = new Product('000003', 'Normal Boots', 'boots', 15000);
        $productDTO = new ProductDTO(
            $product->getSku(),
            $product->getName(),
            $product->getCategory(),
            DiscountApplier::byProduct($product)
        );

        $this->assertSame($productDTO->getSku(), $product->getSku());
        $this->assertSame($productDTO->getName(), $product->getName());
        $this->assertSame($productDTO->getCategory(), $product->getCategory());
        $this->assertIsObject($productDTO->getPrice());
    }

    public function test_product_price_structure()
    {
        $price = new Price(10000, DiscountEnum::PRODUCT_DISCOUNT);
        $serialize = $price->jsonSerialize();

        $this->assertSame($price->getDiscountPercentage(), '15 %');
        $this->assertArrayHasKey('original',$serialize);
        $this->assertArrayHasKey('final',$serialize);
        $this->assertArrayHasKey('discount_percentage',$serialize);
        $this->assertArrayHasKey('currency',$serialize);
    }

}