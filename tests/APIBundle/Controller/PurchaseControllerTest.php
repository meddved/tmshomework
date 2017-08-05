<?php
/**
 * Created by PhpStorm.
 * User: nebojsam
 * Date: 05/08/17
 * Time: 17:39
 */

namespace APIBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PurchaseControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    protected function setUp()
    {
        $this->client = static::createClient(
            [],
            ['HTTP_ACCEPT' => 'application/json']
        );
    }

    protected function tearDown()
    {
        $this->client = null;
        parent::tearDown();
    }

    public function testListAction()
    {
        $crawler = $this->client->request('GET', '/api/v1/purchase');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
    }

}