<?php

namespace Tests\AppBundle\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadData'
        ])->getReferenceRepository();
    }

    public function testGetCategoriesReturnAllCategoriesInJsonFormat()
    {
        $client = static::createClient();

        $client->request('GET', '/api/categories');

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type', 'application/json'
            )
        );

        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertCount(3, $data);
        foreach ($data as $item) {
            $this->assertInternalType('integer', $item['id']);
            $this->assertInternalType('string', $item['name']);
        }
    }
}
