<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 12/03/19
 * Time: 22:15
 */

namespace App\Service;


use App\Entity\Product;

abstract class PricingRule
{
    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var Product
     */
    private $product;

    /**
     * PricingRule constructor.
     * @param int $quantity
     * @param Product $product
     */
    public function __construct(int $quantity, Product $product)
    {
        $this->quantity = $quantity;
        $this->product = $product;
    }


    /**
     * @return integer
     */
    public function getQuantity():? int
    {
        return $this->quantity;

    }


    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return string
     */
    public function getProductCode(): string
    {
        return $this->product->getCode();
    }

    /**
     * @param array $products
     * @return array
     */
    abstract public function applyRule(array $products) :array;

    /**
     * It returns how many times a PriceRule is validated
     * @param array $products
     * @return int
     */
    public function validateRule(array $products) : int
    {
        $matches = 0;
        foreach ($products as $product) {
            if ($product->getCode() == $this->getProductCode()) {
                $matches++;
            }
        }
        if ($matches === 0) {
            return 0;
        }

        return intval($matches / $this->quantity);
    }

    /**
     * For checkout is needed code, name and price of promotion
     * @return Product
     */
    abstract public function getPromoProduct() : Product;
}