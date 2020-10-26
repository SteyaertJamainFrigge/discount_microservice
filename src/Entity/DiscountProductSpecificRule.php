<?php


namespace App\Entity;


class DiscountProductSpecificRule extends DiscountRule
{
    public function execute()
    {
        $price = $this->promotedProduct->getPrice();
        $item = $this->findCartItemByPromotedProduct();
        if($item != null){
            $amount = $item->getAmount();
            $item->setDiscountPrice(round($price * $this->discount * $amount, 2));
        }
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $item = $this->findCartItemByPromotedProduct();
        if($item != null && $item->getAmount() >= $this->minimumAmount){
            return true;
        }
        return false;
    }

    /**
     * @return CartItem|null
     */
    private function findCartItemByPromotedProduct()
    {
        $items = $this->cartItems;
        /** @var CartItem $item */
        foreach ($items as $item){
            if($item->getProduct()->getId() == $this->promotedProduct->getId()){
                return $item;
            }
        }
        return null;
    }


}