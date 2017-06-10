<?php

namespace Tests\AppBundle\Database\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\{User, Article};

class UserArticleFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('user1');
        $user1->setEmail('user1@localhost.com');
        $user1->setPlainPassword('user1');
        $user1->setEnabled(true);

        $article1 = new Article();
        $article1->setTitle('Article1 Title');
        $article1->setContent('Article1 Content');

        $article2 = new Article();
        $article2->setTitle('Article2 Title');
        $article2->setContent('Article2 Content');

        // Se relacionan de las dos formas posibles.
        $article1->setAuthor($user1);
        $user1->addArticle($article2);

        $manager->persist($user1);
        $manager->persist($article1);
        $manager->persist($article2);
        $manager->flush();

        $this->setReference('user1', $user1);
        $this->setReference('article1', $article1);
        $this->setReference('article2', $article2);
    }
}