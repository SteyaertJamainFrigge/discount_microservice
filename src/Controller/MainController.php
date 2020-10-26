<?php


namespace App\Controller;


use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\DiscountBuyOneGetOneFreeDiscount;
use App\Entity\DiscountGeneralRule;
use App\Entity\DiscountProductSpecificRule;
use App\Entity\Product;
use App\Service\DiscountCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Serializer\Exception\MissingConstructorArgumentsException;
use Symfony\Component\Serializer\SerializerInterface;

class MainController extends AbstractController
{

    /**
     * @param Request $request
     * @param DiscountCalculator $discountCalculator
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function handleShoppingCart(Request $request,
                                       DiscountCalculator $discountCalculator,
                                       SerializerInterface $serializer): Response
    {

        //these products should normally be saved in a database and fetched via an ORM.
        $product1 = new Product(1, "HydrogenDioxide (200g) ", 10.50);
        $product3 = new Product(3, "Silver (100g)", 2.60);

        $shoppingCartData = $this->getJson($request);

        try{
            /** @var Cart $cart */
            $cart = $serializer->deserialize($shoppingCartData, Cart::class, "json");
            $cartItems = [];
            foreach ($cart->getCartItems() as $item) {
                $cartItems[] = $serializer->denormalize($item, CartItem::class);
            }
            $cart->setCartItems($cartItems);
            $discountCalculator->setCart($cart);

            // these rules should normally be saved in a database and fetched via OMR
            $rules = $this->createRules($cartItems, $product1, $product3);
            $discountCalculator->setDiscountRules($rules);

            $cart = $discountCalculator->run();
            return new JsonResponse($serializer->serialize($cart, 'json'), Response::HTTP_OK);
        }catch (MissingConstructorArgumentsException $e){
            return new JsonResponse("json invalid", Response::HTTP_BAD_REQUEST);
        }

    }

    private function createRules($cartItems, Product $product1, Product $product3)
    {
        $buyOneGetOneFree = new DiscountBuyOneGetOneFreeDiscount(
            1,
            "Buy one, Get one FREE",
            '0123',
            2,
            $product1->getPrice(),
            $cartItems,
            $product1
        );
        $generalDiscount = new DiscountGeneralRule(
            2,
            "cheapest item 50% off after purchase of 3 different products",
            "4567",
            3,
            0.50,
            $cartItems
        );

        $productSpecificDiscount = new DiscountProductSpecificRule(
            3,
            "20% off",
            "8910",
            0,
            0.20,
            $cartItems,
            $product3
        );
        return [$buyOneGetOneFree, $generalDiscount, $productSpecificDiscount];
    }

    /**
     * Quick check if the data given by the request is really json data.
     *
     * @param Request $request
     * @return resource|string
     */
    private function getJson(Request $request)
    {

        json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new HttpException(400, 'Invalid json');
        }

        return $request->getContent();
    }
}