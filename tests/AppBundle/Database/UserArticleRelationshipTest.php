<?php

namespace Tests\AppBundle\Database;

class UserArticleRelationshipTest extends RelationshipTestCase
{
    public function setUp()
    {
        $this->loadDataFixtures([
            DataFixtures\UserArticleFixtures::class
        ]);

        $this->user1 = $this->doctrine->getRepository('AppBundle:User')
            ->find($this->fixtures->getReference('user1')->getId());
        $this->article1 = $this->doctrine->getRepository('AppBundle:Article')
            ->find($this->fixtures->getReference('article1')->getId());
        $this->article2 = $this->doctrine->getRepository('AppBundle:Article')
            ->find($this->fixtures->getReference('article2')->getId());
    }

    public function testRelationships()
    {
        $user1Articles = $this->user1->getArticles();

        $this->assertSame($this->user1, $this->article1->getAuthor());
        $this->assertSame($this->user1, $this->article2->getAuthor());
        $this->assertContains($this->article1, $user1Articles);
        $this->assertContains($this->article2, $user1Articles);
    }
}