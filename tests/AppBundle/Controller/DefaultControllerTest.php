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
        return [
            ['article1'], ['article2'],
        ];
    }

    /**
     * @dataProvider providerArticlePage
     */
    public function testArticlePage($articleId)
    {
        // Arrange
        $fixtures = $this->loadFixtures([
            DataFixtures\ArticlePageDataFixtures::class
        ])->getReferenceRepository();

        $article = $fixtures->getReference($articleId);
        $client = static::createClient();

        // Act
        $crawler = $client->request('GET', "/article/{$article->getId()}");

        // Asserts
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(
            $article->getTitle(), $crawler->filter('h1.title-article')->text()
        );
        $this->assertContains(
            $article->getContent(), $crawler->filter('.content-article')->text()
        );
        $this->assertContains(
            $article->getAuthor()->getUsername(),
            $crawler->filter('.author-article')->text()
        );
        $this->assertEquals(
            $article->getImageName(),
            $crawler->filter('.image-article')->attr('src')
        );
    }
}
