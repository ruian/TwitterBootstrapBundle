<?php

namespace Ruian\TwitterBootstrapBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestControllerTest extends WebTestCase
{
    public function testAlertBasic()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/test/bootstraptwitter/alert/basic');

        $this->assertTrue($crawler->filter('html:contains("foo bar")')->count() > 0);
    }

    public function testAlertBlock()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/test/bootstraptwitter/alert/block');

        $this->assertTrue($crawler->filter('html:contains("lorem")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("ipsum")')->count() > 0);

        $this->assertTrue($crawler->selectLink('button_foo')->count() > 0);
        $this->assertTrue($crawler->selectLink('button_foo')->attr('class') === "btn class_test");
        $this->assertTrue($crawler->selectLink('button_foo')->attr('href') === "/test/bootstraptwitter/alert/block");
    }

    public function testBreadcrumb()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/test/bootstraptwitter/breadcrumb');

        $this->assertTrue($crawler->filter('html:contains("foo")')->count() > 0);
        $this->assertTrue($crawler->selectLink('foo')->count() > 0);
        $this->assertTrue($crawler->selectLink('foo')->parents()->first()->attr('class') === "active");
        $this->assertTrue($crawler->selectLink('foo')->attr('href') === "/test/bootstraptwitter/breadcrumb");
    }

    public function testTopbar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/test/bootstraptwitter/topbar');

        $this->assertTrue($crawler->filter('html:contains("Homepage")')->count() > 0);
        $this->assertTrue($crawler->selectLink('Homepage')->count() > 0);
        $this->assertTrue($crawler->selectLink('Homepage')->parents()->first()->attr('class') === "active");
        $this->assertTrue($crawler->selectLink('Homepage')->attr('href') === "/test/bootstraptwitter/topbar");

        $this->assertTrue($crawler->selectLink('test parent')->count() > 0);
        $this->assertTrue($crawler->selectLink('test parent')->parents()->first()->selectLink('test child')->count() > 0);
    }
}
