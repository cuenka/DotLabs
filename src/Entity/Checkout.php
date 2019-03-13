<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="dotlab_checkout", indexes={@ORM\Index(name="checkout_idx", columns={"id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CheckoutRepository")
 */
class Checkout
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Many checkouts have Many products.
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="checkouts")
     * @ORM\JoinTable(name="checkout_products")
     */
    private $products;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pricingRules;

    /**
     * Checkout constructor.
     */
    public function __construct(Array $pricingRules)
    {
        $this->pricingRules = $pricingRules;
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Array
     */
    public function getProducts(): ?Array
    {
        return $this->products;
    }

    /**
     * @param ArrayCollection $products
     * @return Checkout
     */
    public function setProducts(ArrayCollection $products): self
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @param Product $product
     * @return Checkout
     */
    public function scan(Product $product): self
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPricingRules(): ?string
    {
        return $this->pricingRules;
    }

    /**
     * @param string $pricingRules
     * @return Checkout
     */
    public function setPricingRules(string $pricingRules): self
    {
        $this->pricingRules = $pricingRules;

        return $this;
    }

    /**
     * @return float
     */
    public function total()
    {
        $total = 0;
        $productsAfterRules = $this->getProductsAfterRules();
        foreach ($productsAfterRules as $product) {
            $total += (float)$product->getPrice();
        }

        return number_format($total, 2,'.','');
    }

    /**
     * @return array
     */
    public function getProductsAfterRules() : array
    {
        $productsAfterRules = $this->products;

        foreach ($this->pricingRules as $pricingRule) {
            $productsAfterRules = $pricingRule->applyRule($productsAfterRules);
        }

        return $productsAfterRules;
    }
}