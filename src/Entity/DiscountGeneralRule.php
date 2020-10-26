<?php


namespace App\Entity;


class DiscountGeneralRule extends DiscountRule
{
    /**
     * @return int
     */
    public function execute(): int
    {
        $item = $this->findCheapestItem($this->cartItems);
        if ($item != null) {
            $price = $item->getProduct()->getPrice();
            $amount = $item->getAmount();
            $item->setDiscountPrice(round($price * $this->discount * $amount,2));
            $item->setActualPrice($item->getActualPrice() - $item->getDiscountPrice());
        }
        return 0;
    }

    public function isValid(): bool
    {
        $cartItems = $this->cartItems;
        if(sizeof($cartItems) >= $this->minimumAmount){
            return true;
        }
        return false;
    }

    /**
     * @param array $items
     * @return CartItem
     */
    private function findCheapestItem(array $items)
    {
        /** @var CartItem $cheapestItem */
        $cheapestItem = null;
        /** @var CartItem $item */
        foreach ($items as $item) {
            if ($cheapestItem == null || $cheapestItem->getProduct()->getPrice() >= $item->getProduct()->getPrice()) {
                $cheapestItem = $item;
            }
        }
        return $cheapestItem;
    }


}