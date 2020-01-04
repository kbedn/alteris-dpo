<?php namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     * @param $url
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider(): ?\Generator
    {
        yield ['/'];
        yield ['/material/'];
        yield ['/material/new'];
        yield ['/material-group/'];
        yield ['/material-group/new'];
        yield ['/unit-of-measure/'];
        yield ['/unit-of-measure/new'];
    }
}
