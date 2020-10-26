<?php


namespace App\Entity;


use JsonSerializable;

class CartItem
{

    private Product $product;

    private int $amount;

    private float $originalPrice;

    private float $discountPrice;

    private float $actualPrice;

    /**
     * CartItem constructor.
     * @param Product $product
     * @param int $amount
     * @param float $originalPrice
     * @param float $discount
     * @param float $actualPrice
     */
    public function __construct(Product $product, int $amount = 0, float $originalPrice = 0, float $actualPrice = 0, float $discount = 0)
    {
        $this->product = $product;
        $this->amount = $amount;
        $this->originalPrice = $originalPrice;
        $this->discountPrice = $discount;
        $this->actualPrice = $actualPrice;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getOriginalPrice(): float
    {
        return $this->originalPrice;
    }

    /**
     * @return float
     */
    public function getDiscountPrice(): float
    {
        return $this->discountPrice;
    }

    /**
     * @return float
     */
    public function getActualPrice(): float
    {
        return $this->actualPrice;
    }

    /**
     * @param float $discountPrice
     */
    public function setDiscountPrice(float $discountPrice): void
    {
        $this->discountPrice = $discountPrice;
    }

    /**
     * @param float $actualPrice
     */
    public function setActualPrice(float $actualPrice): void
    {
        $this->actualPrice = $actualPrice;
    }

    public function calculatePrice(){
        $this->originalPrice = $this->amount * $this->product->getPrice();
        $this->actualPrice = $this->originalPrice - $this->discountPrice;
    }


}