<?php

namespace App\Controller;

use App\Entity\Checkout;
use App\Entity\Product;
use App\Service\BuyOneGetOneFreePricingRule;
use App\Service\BuyThreeForFivePricingRule;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CheckoutController
 * @package App\Controller
 */
class CheckoutController extends Controller
{
    /**
     * @Route("/", name="checkout_index")
     */
    public function index()
    {
        $pricingRules = [];
        $entityManager = $this->getDoctrine()->getManager();

        $pomegranate = $entityManager->getrepository(Product::class)->findOneBy(['code'=>'PG1']);
        $banana = $entityManager->getrepository(Product::class)->findOneBy(['code'=>'BN1']);
        $lemon = $entityManager->getrepository(Product::class)->findOneBy(['code'=>'LE1']);
        $twoForOne = new BuyOneGetOneFreePricingRule(2, $pomegranate);
        $threeForfive = new BuyThreeForFivePricingRule(3, $banana);
        $pricingRules = [$twoForOne, $threeForfive];

        $checkout = new Checkout($pricingRules);
        $checkout->scan($banana)->scan($banana)->scan($banana)->scan($pomegranate)->scan($pomegranate);
        $total = $checkout->total();


        return $this->render('checkout/index.html.twig', [
            'productsBeforeRules' => $checkout->getProducts(),
            'productsAfterRules' => $checkout->getProductsAfterRules(),
            'total' => $total,
        ]);
    }
}
