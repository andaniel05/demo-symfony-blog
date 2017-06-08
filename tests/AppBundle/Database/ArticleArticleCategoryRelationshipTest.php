<?php

namespace Tests\AppBundle\Database;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Tests\AppBundle\Database\DataFixtures\ArticleArticleCategoryFixtures;

class ArticleArticleCategoryRelationshipTest extends WebTestCase
{
    public function setUp()
    {
        $this->fixtures = $this->loadFixtures([
            ArticleArticleCategoryFixtures::class
        ])->getReferenceRepository();

        $this->em = $this->getContainer()->get('doctrine')->getManager();

        $this->category1 = $this->fixtures->getReference('category1');
        $this->article1 = $this->fixtures->getReference('article1');
        $this->article2 = $this->fixtures->getReference('article2');
    }

    public function testRelationships()
    {
        $category1Articles = $this->category1->getArticles();

        $this->assertContains($this->article1, $category1Articles);
        $this->assertContains($this->article2, $category1Articles);
        $this->assertContains($this->category1, $this->article1->getCategories());
        $this->assertContains($this->category1, $this->article2->getCategories());
    }
}