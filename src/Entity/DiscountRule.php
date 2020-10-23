<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DiscountRule
 *
 * @author frigg
 */
class DiscountRule {
    
    /**
     *
     * @var int
     */
    private $id;
    
    /**
     * if promotedProduct is not null, it will only apply to the given product.
     * if promotedProduct is null, it applies to the shopping cart
     * @var Product 
     */
    private $promotedProduct;
    /**
     *
     * @var string
     */
    private $description;

    /**
     *
     * @var string
     */
    private $promotionCode;
    
    /**
     *
     * @var int
     */
    private $minimumAmount;
    
    /**
     *
     * @var float
     */
    private $discount;
            
    function __construct(int $id, Product $promotedProduct , string $description, string $promotionCode, int $minimumAmount, float $discount) {
        $this->id = $id;
        $this->promotedProduct = $promotedProduct;
        $this->description = $description;
        $this->promotionCode = $promotionCode;
        $this->minimumAmount = $minimumAmount;
        $this->discount = $discount;
    }

    function getId(): int {
        return $this->id;
    }

    function getPromotedProduct(): Product {
        return $this->promotedProduct;
    }

    function getDescription(): string {
        return $this->description;
    }

    function getPromotionCode(): string {
        return $this->promotionCode;
    }

    function getMinimumAmount(): int {
        return $this->minimumAmount;
    }

    function getDiscount(): float {
        return $this->discount;
    }
}
