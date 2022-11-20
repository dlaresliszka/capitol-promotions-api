<?php

namespace App\DomainLayer\DTO;

use App\DomainLayer\ValueObjects\Price;

final class ProductDTO implements \JsonSerializable
{
    private string $id;
    private string $sku;
    private string $name;
    private string $category;
    private $price;

    public function __construct(string $sku, string $name, string $category, Price $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'category' => $this->getCategory(),
            'price' => $this->getPrice(),
        ];
    }
}
