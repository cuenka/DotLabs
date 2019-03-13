<?php

namespace App\Service;


use App\Entity\Product;

interface PricingRuleInterface
{
    /**
     * @return integer
     */
    public function getQuantity():? int;

    /**
     * @param integer $quantity
     * @return PricingRuleInterface
     */
    public function setQuantity(int $quantity): self;

    /**
     * @return Product
     */
    public function getProduct(): Product;

    /**
     * @param Product $product
     * @return PricingRuleInterface
     */
    public function setProduct(Product $product): self;

    /**
     * @return float
     */
    public function applyRule() :float;
}