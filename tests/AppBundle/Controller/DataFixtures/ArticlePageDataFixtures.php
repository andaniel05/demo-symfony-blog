<?php

namespace Tests\AppBundle\Controller\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\{Article, User};

class ArticlePageDataFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('user1');
        $user1->setEmail('user1@localhost.com');
        $user1->setPlainPassword('user1');
        $user1->setEnabled(true);

        $user2 = new User();
        $user2->setUsername('user2');
        $user2->setEmail('user2@localhost.com');
        $user2->setPlainPassword('user2');
        $user2->setEnabled(true);

        $article1 = new Article();
        $article1->setTitle('Article1 Title')
            ->setContent('Article1 Content')
            ->setExcerpt('Article1 Excerpt')
            ->setAuthor($user1)
            ->setImageName('image1.jpg');

        $article2 = new Article();
        $article2->setTitle('Article2 Title')
            ->setContent('Article2 Content')
            ->setExcerpt('Article2 Excerpt')
            ->setAuthor($user2)
            ->setImageName('image2.jpg');

        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($article1);
        $manager->persist($article2);
        $manager->flush();

        $this->setReference('article1', $article1);
        $this->setReference('article2', $article2);
    }
}