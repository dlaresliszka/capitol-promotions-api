<?php
namespace App\ApplicationLayer\Product;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use App\DomainLayer\Models\Product;
use App\DomainLayer\ValueObjects\Price;
use App\DomainLayer\Enum\DiscountEnum;


class DiscountApplier
{

    public static function byProduct(Product $product): Price
    {
        $discountToApply = DiscountEnum::NO_DISCOUNT;
        if($product->getCategory() == 'boots') {
            $discountToApply = DiscountEnum::CATEGORY_DISCOUNT;
        } elseif ($product->getSku() == '000003') {
            $discountToApply = DiscountEnum::PRODUCT_DISCOUNT;
        }

        return new Price($product->getPrice(), $discountToApply);
    }
}
