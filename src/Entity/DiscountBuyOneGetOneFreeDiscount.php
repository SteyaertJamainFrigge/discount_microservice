<?php


namespace App\Entity;


class DiscountBuyOneGetOneFreeDiscount extends DiscountRule
{

    public function execute()
    {
        $price = $this->promotedProduct->getPrice();
        $item = $this->findCartItemByPromotedProduct();
        if($item != null){
            $item->setDiscountPrice($price);
        }
        return 0;
    }

    public function isValid(): bool
    {
        $item = $this->findCartItemByPromotedProduct();
        if($item->getAmount() >= $this->minimumAmount){
            return true;
        }
        return false;
    }

    private function findCartItemByPromotedProduct(): CartItem
    {
        $items = $this->cartItems;
        /** @var CartItem $item */
        foreach ($items as $item) {
            if ($item->getProduct()->getId() == $this->promotedProduct->getId()) {
                return $item;
            }
        }
        return null;
    }
}