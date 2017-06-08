<?php

namespace Tests\AppBundle\Database;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class RelationshipTestCase extends WebTestCase
{
    public function __construct()
    {
        $this->doctrine = $this->getContainer()->get('doctrine');
        $this->em = $this->doctrine->getManager();
    }

    public function loadDataFixtures(array $classes)
    {
        $this->fixtures = $this->loadFixtures($classes)->getReferenceRepository();
    }
}