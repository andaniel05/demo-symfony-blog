<?php

namespace Tests\AppBundle\Database\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\{Article, ArticleCategory};

class ArticleArticleCategoryFixtures extends AbstractFixture
{
    /**
     * Crea una categoría con 2 artículos.
     */
    public function load(ObjectManager $manager)
    {
        $category1 = new ArticleCategory();
        $category1->setName('Category1');

        $article1 = new Article();
        $article1->setTitle('Article1 Title');

        $article2 = new Article();
        $article2->setTitle('Article2 Title');

        // Se relacionan de las 2 formas posibles.
        $category1->addArticle($article1);
        $article2->addCategory($category1);

        $manager->persist($category1);
        $manager->persist($article1);
        $manager->persist($article2);

        $this->setReference('category1', $category1);
        $this->setReference('article1', $article1);
        $this->setReference('article2', $article2);
    }
}