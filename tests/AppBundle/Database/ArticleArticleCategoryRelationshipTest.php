<?php

namespace Tests\AppBundle\Database;

class ArticleArticleCategoryRelationshipTest extends RelationshipTestCase
{
    public function setUp()
    {
        $this->loadDataFixtures([
            DataFixtures\ArticleArticleCategoryFixtures::class
        ]);

        $this->category1 = $this->doctrine->getRepository('AppBundle:ArticleCategory')
            ->find($this->fixtures->getReference('category1')->getId());
        $this->article1 = $this->doctrine->getRepository('AppBundle:Article')
            ->find($this->fixtures->getReference('article1')->getId());
        $this->article2 = $this->doctrine->getRepository('AppBundle:Article')
            ->find($this->fixtures->getReference('article2')->getId());
    }

    public function testRelationships()
    {
        $category1Articles = $this->category1->getArticles();

        $this->assertContains($this->article1, $category1Articles);
        $this->assertContains($this->article2, $category1Articles);
        $this->assertContains($this->category1, $this->article1->getCategories());
        $this->assertContains($this->category1, $this->article2->getCategories());
    }

    public function testCategoryIsUnregisteredFromArticleWhenCategoryIsRemoved()
    {
        $this->em->remove($this->category1);
        $this->em->flush();

        $article1 = $this->doctrine->getRepository('AppBundle:Article')
            ->find($this->fixtures->getReference('article1')->getId());

        $this->assertEquals(0, $article1->getCategories()->count());
    }

    public function testArticleIsUnregisteredFromCategoryWhenArticleIsRemoved()
    {
        $this->em->remove($this->article1);
        $this->em->flush();

        $category1 = $this->doctrine->getRepository('AppBundle:ArticleCategory')
            ->find($this->fixtures->getReference('category1')->getId());

        $this->assertEquals(1, $category1->getArticles()->count());
        $this->assertContains($this->article2, $category1->getArticles());
    }
}