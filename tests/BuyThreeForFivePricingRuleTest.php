<?php

use App\Service\BuyThreeForFivePricingRule;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Product;

/**
 * Class BuyThreeForFivePricingRuleTest
 */
class BuyThreeForFivePricingRuleTest extends WebTestCase
{

    /**
     * @dataProvider applyRuleProvider
     * @param array   $products
     * @param integer $quantity
     * @param Product $product
     * @param integer $expected
     */
    public function testApplyRule(array $products,int $quantity,Product $product,int $expected)
    {
        $instance = new BuyThreeForFivePricingRule($quantity, $product);

        $this->assertEquals($expected, count($instance->applyRule($products)));
    }

    /**
     * @dataProvider getPromoProductProvider
     * @param integer $quantity
     * @param Product $product
     */
    public function testGetPromoProduct(int $quantity, Product $product)
    {
        $instance = new BuyThreeForFivePricingRule($quantity, $product);

        $this->assertInstanceOf(Product::class, $instance->getPromoProduct());
    }

    /**
     * Provider
     * @return array
     */
    public function applyRuleProvider(): array
    {
        $client = static::createClient();

        $productRepository = $client->getContainer()->get('doctrine')->getManager()->getRepository(Product::class);

        $pomegranate = $productRepository->findOneBy(['code'=>'PG1']);
        $banana = $productRepository->findOneBy(['code'=>'BN1']);
        $lemon = $productRepository->findOneBy(['code'=>'LE1']);

        return[
            [[$pomegranate, $pomegranate, $pomegranate], 3,$pomegranate, 1],
            [[$banana, $pomegranate, $pomegranate], 3, $pomegranate, 3],
            [[$lemon, $lemon, $pomegranate], 3, $pomegranate, 3],
        ];
    }

    /**
     * Provider
     * @return array
     */
    public function getPromoProductProvider(): array
    {
        $client = static::createClient();

        $productRepository = $client->getContainer()->get('doctrine')->getManager()->getRepository(Product::class);

        $pomegranate = $productRepository->findOneBy(['code'=>'PG1']);
        $banana = $productRepository->findOneBy(['code'=>'BN1']);

        return [
            [2, $pomegranate]
        ];

    }
}
