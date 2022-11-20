<?php
namespace App\DomainLayer\Models;

use Doctrine\ORM\Mapping AS ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 * 
 */
class Product {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, nullable=false)
     */
    private $sku;
    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $name;
    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $category;
    /**
     * @ORM\Column(type="integer", length=32,  nullable=false)
     */
    private $price;

    public function __construct(string $sku, string $name, string $categoryName, int $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->category = $categoryName;
        $this->price = $price;
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

    public function getPrice(): int
    {
        return $this->price;
    }
}