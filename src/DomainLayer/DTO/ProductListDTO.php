<?php
namespace App\DomainLayer\DTO;

final class ProductListDTO implements \JsonSerializable
{
    private array $products;

    public function __construct(...$products)
    {
        $this->products = $products;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function jsonSerialize(): mixed
    {
        return get_class_vars($this);
    }
}