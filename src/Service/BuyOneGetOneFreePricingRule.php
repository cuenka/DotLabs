<?php

namespace App\Service;

use App\Entity\Product;

/**
 * Class BuyOneGetOneFreePricingRule
 * @package App\Service
 */
class BuyOneGetOneFreePricingRule extends PricingRule
{
    /**
     * @param array $products
     * @return array
     */
    public function applyRule(array $products): array
    {
        // How many times the rule is applied?
        $applyRuleTimes = $this->validateRule($products);
        // items Affected
        $items = $applyRuleTimes * $this->getQuantity();
        // Remove items affected
        foreach ($products as $key => $product) {
            if ($this->getProductCode() == $product->getCode() && $items > 0) {
                unset($products[$key]);
                $items--;
            }
        }
        // add Special Rule/Promotion
        for ($i = 0; $i < $applyRuleTimes; $i++) {
            array_push($products, $this->getPromoProduct());
        }
        return $products;
    }

    /**
     * @return Product
     */
    public function getPromoProduct(): Product
    {
        $product= new Product();
        $product->setCode('2X1')
            ->setName('2 for 1 promotion in '. $this->getProduct()->getName())
            ->setPrice($this->getProduct()->getPrice());
        return $product;
    }
}