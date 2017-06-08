<?php

namespace Tests\AppBundle\Entity;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Article;

class ArticleTest extends TestCase
{
    /**
     * Prueba que por defecto la fecha de los artículos se corresponde con el
     * momento actual.
     */
    public function testDateIsCurrentTimeByDefault()
    {
        $now = new \DateTime();
        $article = new Article();

        $diff = $article->getDate()->getTimestamp() - $now->getTimestamp();

        $this->assertLessThan(0.1, $diff);
    }
}