<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\{Route, ParamConverter};
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;

class BlogController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('page-index.html.twig');
    }

    /**
     * @Route("/article/{id}", name="article")
     * @ParamConverter("article", class="AppBundle:Article")
     */
    public function articleAction(Article $article, Request $request)
    {
        return $this->render('page-article.html.twig', ['article' => $article]);
    }
}
