<?php
namespace App\DomainLayer\ValueObjects;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use App\DomainLayer\Enum\CurrencyEnum;

final class Price implements \JsonSerializable
{

    private int $original;

    private int $final;

    private $discountPercentage = null;

    private string $currency;

    public function __construct(int $originalPrice, ?int $discountPercentage)
    {
        if ($originalPrice < 0) {
            throw new InvalidArgumentException("Invalid parameter Original Amount cannot be negative");
        }

        $this->original = $originalPrice;
        $this->final = $originalPrice;
        $this->currency = CurrencyEnum::EURO;
        if($discountPercentage !== null) {
            $this->final = ($originalPrice - ($originalPrice * ($discountPercentage / 100))) ;
            $this->discountPercentage = "{$discountPercentage} %";
        }
    }

    public function getOriginal(): int
    {
        return $this->original;
    }

    public function getFinal(): int
    {
        return $this->final;
    }

    public function getDiscountPercentage(): ?string
    {
        return $this->discountPercentage;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'original' => $this->getOriginal(),
            'final' => $this->getFinal(),
            'discount_percentage' => $this->getDiscountPercentage(),
            'currency' => $this->getCurrency(),
        ];
    }

}
