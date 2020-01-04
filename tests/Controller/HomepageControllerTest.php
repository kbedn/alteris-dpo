<?php namespace App\Controller\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomepageControllerTest extends WebTestCase
{
    public function testHomepage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Links ✅');
        self::assertSelectorExists('ul.list-unstyled');
        self::assertGreaterThan(
            2,
            $crawler->filter('li')->count()
        );
    }
}
