<?php
namespace App\DomainLayer\Enum;

final class DiscountEnum
{
    public const CATEGORY_DISCOUNT = 30;
    public const PRODUCT_DISCOUNT = 15;
    public const NO_DISCOUNT = null;

    public const DISCOUNTS = [
        self::CATEGORY_DISCOUNT,
        self::PRODUCT_DISCOUNT,
        self::NO_DISCOUNT
    ];
}
