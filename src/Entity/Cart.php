<?php

namespace App\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cart
 *
 * @author frigg
 */
class Cart{


    private array $cartItems;

    private array $promotionCodes;

    private float $originalTotalPrice;

    private float $totalDiscount;

    private float $actualTotalPrice;

    /**
     * Cart constructor.
     * @param array $cartItems
     * @param array $promotionCodes
     * @param float $originalPrice
     * @param float $totalDiscount
     * @param float $actualPrice
     */
    public function __construct(float $originalPrice = 0,
                                float $totalDiscount = 0,
                                float $actualPrice = 0,
                                array $cartItems = [],
                                array $promotionCodes = [])
    {
        $this->cartItems = $cartItems;
        $this->promotionCodes = $promotionCodes;
        $this->originalTotalPrice = $originalPrice;
        $this->totalDiscount = $totalDiscount;
        $this->actualTotalPrice = $actualPrice;
    }

    /**
     * @return array
     */
    public function getCartItems(): array
    {
        return $this->cartItems;
    }

    /**
     * @return array
     */
    public function getPromotionCodes(): array
    {
        return $this->promotionCodes;
    }

    /**
     * @param array $cartItems
     */
    public function setCartItems(array $cartItems): void
    {
        $this->cartItems = $cartItems;
    }

    /**
     * @param array $promotionCodes
     */
    public function setPromotionCodes(array $promotionCodes): void
    {
        $this->promotionCodes = $promotionCodes;
    }

    /**
     * @param float $originalTotalPrice
     */
    public function setOriginalTotalPrice(float $originalTotalPrice): void
    {
        $this->originalTotalPrice = $originalTotalPrice;
    }

    /**
     * @param float $totalDiscount
     */
    public function setTotalDiscount(float $totalDiscount): void
    {
        $this->totalDiscount = $totalDiscount;
    }

    /**
     * @param float $actualTotalPrice
     */
    public function setActualTotalPrice(float $actualTotalPrice): void
    {
        $this->actualTotalPrice = $actualTotalPrice;
    }

    public function getTotalDiscount()
    {
        return $this->totalDiscount;
    }

    /**
     * @return float
     */
    public function getOriginalTotalPrice(): float
    {
        return $this->originalTotalPrice;
    }

    /**
     * @return float
     */
    public function getActualTotalPrice(): float
    {
        return $this->actualTotalPrice;
    }

}
