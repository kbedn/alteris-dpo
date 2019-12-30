<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MaterialControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/material/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('h1', 'Material index');
    }
}
