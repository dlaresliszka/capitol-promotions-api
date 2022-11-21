<?php
namespace App\ApplicationLayer\Product;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use App\DomainLayer\Models\Product;
use App\DomainLayer\ValueObjects\Price;
use App\DomainLayer\Enum\DiscountEnum;


class DiscountApplier
{
    private const BOOTS_CATEGORY = 'boots';
    private const SKU_BY_DEFAULT = '000003';


    public static function byProduct(Product $product): Price
    {
        $discountToApply = DiscountEnum::NO_DISCOUNT;
        if($product->getCategory() == self::BOOTS_CATEGORY) {
            $discountToApply = DiscountEnum::CATEGORY_DISCOUNT;
        } elseif ($product->getSku() == self::SKU_BY_DEFAULT) {
            $discountToApply = DiscountEnum::PRODUCT_DISCOUNT;
        }

        return new Price($product->getPrice(), $discountToApply);
    }
}
