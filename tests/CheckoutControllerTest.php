<?php

use App\Controller\CheckoutController;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class CheckoutControllerTest
 */
class CheckoutControllerTest extends WebTestCase
{
    /**
     * Test index
     */
    public function testIndex()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('checkout_index');

        $crawler = $client->request('GET', $url);

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("DotLabs")')->count()
        );

    }
}
