<?php namespace App\Controller\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MaterialControllerTest extends WebTestCase
{
    public function testMaterialIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/material/');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Material index');
    }

}
