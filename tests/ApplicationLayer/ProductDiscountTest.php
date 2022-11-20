<?php
namespace App\Tests\ApplicationLayer;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use App\DomainLayer\Enum\DiscountEnum;
use App\DomainLayer\Models\Product;
use App\DomainLayer\ValueObjects\Price;
use App\ApplicationLayer\Product\DiscountApplier;

class ProductDiscountTest extends TestCase
{
    public function test_did_not_apply_discount()
    {
        $testProduct = new Product('000005', 'Runners shoes', 'shoes', 99000);
        $discount = DiscountApplier::byProduct($testProduct);
        
        $this->assertSame($discount->getFinal(), $discount->getOriginal());
        $this->assertNull($discount->getDiscountPercentage());
    }

    public function test_did_apply_discount()
    {
        $testProduct = new Product('000002', 'Construction boots', 'boots', 37000);
        $discount = DiscountApplier::byProduct($testProduct);
        
        $this->assertGreaterThan($discount->getFinal(), $discount->getOriginal());
        $this->assertSame($discount->getDiscountPercentage(), '30 %');
    }

    public function test_did_apply_discount_by_category()
    {
        $testProduct = new Product('000002', 'Construction boots', 'boots', 37000);
        $discount = DiscountApplier::byProduct($testProduct);
        
        $this->assertGreaterThan($discount->getFinal(), $discount->getOriginal());
        $this->assertSame($discount->getDiscountPercentage(), DiscountEnum::CATEGORY_DISCOUNT.' %');
    }

    public function test_did_apply_discount_by_sku()
    {
        $testProduct = new Product('000003', 'Construction boots', 'Jumper', 37000);
        $discount = DiscountApplier::byProduct($testProduct);
        
        $this->assertGreaterThan($discount->getFinal(), $discount->getOriginal());
        $this->assertSame($discount->getDiscountPercentage(), DiscountEnum::PRODUCT_DISCOUNT.' %');
    }

    public function test_did_discount_colission_resolved()
    {
        $testProduct = new Product('000003', 'Military Boots', 'boots', 37000);
        $discount = DiscountApplier::byProduct($testProduct);

        $this->assertGreaterThan($discount->getFinal(), $discount->getOriginal());
        $this->assertSame($discount->getDiscountPercentage(), DiscountEnum::CATEGORY_DISCOUNT.' %');
    }

}