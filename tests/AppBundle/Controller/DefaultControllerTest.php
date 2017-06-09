<?php

namespace Tests\AppBundle\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function providerArticlePage()
    {
        $fixtures = $this->loadFixtures([
            DataFixtures\ArticlePageDataFixtures::class
        ])->getReferenceRepository();

        $article1 = $fixtures->getReference('article1');
        $article2 = $fixtures->getReference('article2');

        return [
            [$article1], [$article2],
        ];
    }

    /**
     * @dataProvider providerArticlePage
     */
    public function testArticlePage($article)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', "/article/{$article->getId()}");

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            $article->getTitle(),
            $crawler->filter('h1.title-article')->text()
        );
    }
}
