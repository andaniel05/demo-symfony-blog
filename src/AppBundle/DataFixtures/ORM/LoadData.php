<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\{Article, ArticleCategory};

class LoadData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadCategories($manager);
        $this->loadArticles($manager);

        $manager->flush();
    }

    public function loadCategories(ObjectManager $manager)
    {
        $category1 = new ArticleCategory();
        $category1->setName('Category1');

        $category2 = new ArticleCategory();
        $category2->setName('Category2');

        $category3 = new ArticleCategory();
        $category3->setName('Category3');

        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);
    }

    public function loadArticles(ObjectManager $manager)
    {
    }
}