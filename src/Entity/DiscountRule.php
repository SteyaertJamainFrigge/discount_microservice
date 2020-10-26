<?php

namespace App\Entity;

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
abstract class DiscountRule {

    protected int $id;

    protected Product $promotedProduct;

    protected array $cartItems;

    protected string $description;

    protected string $promotionCode;

    protected int $minimumAmount;

    protected float $discount;

    public function __construct(int $id,
                                string $description,
                                string $promotionCode,
                                int $minimumAmount,
                                float $discount,
                                array $cartItems,
                                Product $promotedProduct = null) {
        $this->id = $id;
        $this->description = $description;
        $this->promotionCode = $promotionCode;
        $this->minimumAmount = $minimumAmount;
        $this->discount = $discount;
        $this->cartItems = $cartItems;
        if($promotedProduct != null){
            $this->promotedProduct = $promotedProduct;
        }
    }

    public function getId(): int {
        return $this->id;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getPromotionCode(): string {
        return $this->promotionCode;
    }

    abstract public function execute();

    abstract public function isValid(): bool;

}
