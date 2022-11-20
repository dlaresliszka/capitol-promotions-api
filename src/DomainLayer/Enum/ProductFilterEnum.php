<?php
namespace App\DomainLayer\Enum;

final class ProductFilterEnum
{
    public const CATEGORY_FILTER_NAME = 'category';
    public const PRICE_FILTER_NAME = 'price';

    public const FILTERS = [
        self::CATEGORY_FILTER_NAME,
        self::PRICE_FILTER_NAME,
    ];
}
