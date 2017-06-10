<?php

namespace Tests\AppBundle\Controller\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Article;

class ArticlePageDataFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $article1 = new Article();
        $article1->setTitle('Article1 Title')
            ->setContent('Article1 Content')
            ->setExcerpt('Article1 Excerpt');

        $article2 = new Article();
        $article2->setTitle('Article2 Title')
            ->setContent('<p>Article2 Content</p>')
            ->setExcerpt('Article2 Excerpt');

        $manager->persist($article1);
        $manager->persist($article2);
        $manager->flush();

        $this->setReference('article1', $article1);
        $this->setReference('article2', $article2);
    }
}