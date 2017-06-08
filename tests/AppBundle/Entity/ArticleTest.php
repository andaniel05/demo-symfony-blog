<?php

namespace Tests\AppBundle\Entity;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Article;

class ArticleTest extends TestCase
{
    /**
     * Prueba que la fecha de los artículos es el momento actual
     * por defecto.
     */
    public function testDateIsCurrentTimeByDefault()
    {
        $now = new \DateTime();
        $article = new Article();

        $diff = $article->getDate()->getTimestamp() - $now->getTimestamp();

        $this->assertLessThan(0.1, $diff);
    }
}