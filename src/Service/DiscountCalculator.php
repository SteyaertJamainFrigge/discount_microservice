<?php

namespace App\Service;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\DiscountRule;

/**
 * Description of DiscountCalculator
 *
 * @author frigg
 */
class DiscountCalculator
{

    private Cart $cart;

    private array $discountRules;

    /**
     * the cart and discount rules must be given to the service before running it.
     * @return Cart
     */
    public function run()
    {
        $this->executeDiscounts();
        $this->calculateTotalPrice();
        return $this->cart;
    }

    /**
     * This method looks if any of the promo codes in the cart correspond with any promo code of a discount rule.
     * Afterwards it checks if the rule it's conditions is met.
     * And lastly, it will tell the discount rule to execute.
     */
    private function executeDiscounts(): void
    {
        $foundDiscountRules = [];
        /** @var string $code */
        foreach ($this->cart->getPromotionCodes() as $code) {
            $foundDiscountRule = $this->findDiscountRulesByPromoCode($code);
            if($foundDiscountRule != null){
                $foundDiscountRules[] = $foundDiscountRule;
            }
        }
        /** @var DiscountRule $ruleToExecute */
        foreach ($foundDiscountRules as $ruleToExecute) {
            if ($ruleToExecute->isValid()) {
                $ruleToExecute->execute();
            }
        }
    }

    /**
     * this method calculates the actual total price of the cart.
     */
    private function calculateTotalPrice()
    {
        $totalPrice = 0;
        $totalDiscount = 0;
        $cartItems = $this->cart->getCartItems();
        /** @var CartItem $item */
        foreach ($cartItems as $item) {
            $item->calculatePrice();
            $totalPrice += $item->getOriginalPrice();
            $totalDiscount += $item->getDiscountPrice();
        }
        $this->cart->setOriginalTotalPrice($totalPrice);
        $this->cart->setTotalDiscount($totalDiscount);
        $this->cart->setActualTotalPrice($this->cart->getOriginalTotalPrice() - $totalDiscount);
    }

    /**
     * This method returns the discount rule corresponding with the given promo code.
     *
     * @param string $promoCode
     * @return DiscountRule|null
     */
    private function findDiscountRulesByPromoCode(string $promoCode)
    {
        $validDiscountRule = null;
        /** @var DiscountRule $rule */
        foreach ($this->discountRules as $rule) {
            if ($promoCode == $rule->getPromotionCode()) {
                $validDiscountRule = $rule;
                break;
            }
        }
        return $validDiscountRule;
    }

    /**
     * @param Cart $cart
     */
    public function setCart(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @param array $discountRules
     */
    public function setDiscountRules(array $discountRules)
    {
        $this->discountRules = $discountRules;
    }


}
