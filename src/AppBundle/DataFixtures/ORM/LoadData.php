<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\{User, Article, ArticleCategory};

class LoadData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->lorem   = nl2br(file_get_contents(__DIR__ . '/lorem.txt'));
        $this->excerpt = nl2br(file_get_contents(__DIR__ . '/excerpt.txt'));

        $this->loadUsers();
        $this->loadCategories();
        $this->loadArticles();

        $manager->flush();
    }

    public function loadUsers()
    {
        $this->admin = $admin = new User();
        $admin->setUsername('admin');
        $admin->setEmail('admin@localhost.com');
        $admin->setPlainPassword('admin');
        $admin->setEnabled(true);
        $admin->setRoles(['ROLE_ADMIN']);

        $this->author1 = $author1 = new User();
        $author1->setUsername('author1');
        $author1->setEmail('author1@localhost.com');
        $author1->setPlainPassword('author1');
        $author1->setEnabled(true);
        $author1->setRoles(['ROLE_AUTHOR']);

        $this->author2 = $author2 = new User();
        $author2->setUsername('author2');
        $author2->setEmail('author2@localhost.com');
        $author2->setPlainPassword('author2');
        $author2->setEnabled(true);
        $author2->setRoles(['ROLE_AUTHOR']);

        $this->manager->persist($admin);
        $this->manager->persist($author1);
        $this->manager->persist($author2);
    }

    public function loadCategories()
    {
        $this->category1 = $category1 = new ArticleCategory();
        $category1->setName('Category1');

        $this->category2 = $category2 = new ArticleCategory();
        $category2->setName('Category2');

        $this->category3 = $category3 = new ArticleCategory();
        $category3->setName('Category3');

        $this->manager->persist($category1);
        $this->manager->persist($category2);
        $this->manager->persist($category3);
    }

    public function loadArticles()
    {
        $this->article1 = $article1 = new Article();
        $article1->setTitle('Article1')
            ->setContent($this->lorem)
            ->setExcerpt($this->excerpt)
            ->addCategory($this->category1)
            ->setAuthor($this->author1);

        $this->article2 = $article2 = new Article();
        $article2->setTitle('Article2')
            ->setContent($this->lorem)
            ->setExcerpt($this->excerpt)
            ->addCategory($this->category2)
            ->setAuthor($this->author1);

        $this->article3 = $article3 = new Article();
        $article3->setTitle('Article3')
            ->setContent($this->lorem)
            ->setExcerpt($this->excerpt)
            ->addCategory($this->category3)
            ->setAuthor($this->author1);

        $this->article4 = $article4 = new Article();
        $article4->setTitle('Article4')
            ->setContent($this->lorem)
            ->setExcerpt($this->excerpt)
            ->addCategory($this->category1)
            ->addCategory($this->category2)
            ->setAuthor($this->author1);

        $this->article5 = $article5 = new Article();
        $article5->setTitle('Article5')
            ->setContent($this->lorem)
            ->setExcerpt($this->excerpt)
            ->addCategory($this->category1)
            ->addCategory($this->category3)
            ->setAuthor($this->author2);

        $this->article6 = $article6 = new Article();
        $article6->setTitle('Article6')
            ->setContent($this->lorem)
            ->setExcerpt($this->excerpt)
            ->addCategory($this->category2)
            ->addCategory($this->category3)
            ->setAuthor($this->author2);

        $this->article7 = $article7 = new Article();
        $article7->setTitle('Article7')
            ->setContent($this->lorem)
            ->setExcerpt($this->excerpt)
            ->addCategory($this->category1)
            ->addCategory($this->category2)
            ->addCategory($this->category3)
            ->setAuthor($this->author2);

        $this->manager->persist($article1);
        $this->manager->persist($article2);
        $this->manager->persist($article3);
        $this->manager->persist($article4);
        $this->manager->persist($article5);
        $this->manager->persist($article6);
        $this->manager->persist($article7);
    }
}