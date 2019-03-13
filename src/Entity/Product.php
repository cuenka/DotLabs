<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="dotlab_product", indexes={@ORM\Index(name="product_idx", columns={"id"})})
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=3)
     * @Assert\Length(
     *      min = 3,
     *      max = 3,
     *      minMessage = "Product code must be at least {{ limit }} characters long",
     *      maxMessage = "Product code cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Type(type="alnum")
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, name="product_name")
     */
    private $name;

    /**
     * @ORM\Column(type="float", name="product_price", scale=2)
     */
    private $price;

    /**
     * Many Products have Many Checkouts.
     * @ORM\ManyToMany(targetEntity="Checkout", mappedBy="products")
     */
    private $checkouts;

    /**
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Product
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Product
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
