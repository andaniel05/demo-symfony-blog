<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\{Route, Method};
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use AppBundle\Entity\{Article, ArticleCategory};

/**
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/categories", name="api_get_categories")
     * @Method("GET")
     */
    public function getCategoriesAction(Request $request)
    {
        $categories = $this->getDoctrine()
            ->getRepository('AppBundle:ArticleCategory')
            ->findAll();

        $data = [];
        foreach ($categories as $category) {
            $data[] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
            ];
        }

        return new JsonResponse($data);
    }

    /**
     * @Route("/articles", name="api_get_articles")
     * @Method("GET")
     */
    public function getArticlesAction(Request $request)
    {
        $cacheManager = $this->get('liip_imagine.cache.manager');
        $helper       = $this->container->get('vich_uploader.templating.helper.uploader_helper');

        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM AppBundle:Article a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            3
        );

        $articles = [];
        foreach ($pagination->getItems() as $article) {

            $categories = [];
            foreach ($article->getCategories() as $category) {
                $categories[] = [
                    'id'   => $category->getId(),
                    'name' => $category->getName(),
                ];
            }

            $imagePath = $helper->asset($article, 'imageFile');

            $articles[] = [
                'id'         => $article->getId(),
                'title'      => $article->getTitle(),
                'categories' => $categories,
                'excerpt'    => $article->getExcerpt(),
                'url'        => $this->generateUrl('article', ['id' => $article->getId()]),
                'thumbnail'  => $cacheManager->getBrowserPath($imagePath, 'article_thumbnail'),
            ];
        }

        $data = [
            'articles' => $articles,
            'paginationData' => $pagination->getPaginationData(),
        ];

        return new JsonResponse($data);
    }

    // /**
    //  * @Route("/articles", name="api_get_articles")
    //  * @Method("GET")
    //  */
    // public function getArticlesAction(Request $request)
    // {
    //     $imagineCacheManager = $this->get('liip_imagine.cache.manager');
    //     $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');

    //     $articles = $this->getDoctrine()
    //         ->getRepository('AppBundle:Article')
    //         ->findAll();

    //     $data = [];
    //     foreach ($articles as $article) {

    //         $categories = [];
    //         foreach ($article->getCategories() as $category) {
    //             $categories[] = [
    //                 'id'   => $category->getId(),
    //                 'name' => $category->getName(),
    //             ];
    //         }

    //         $imagePath = $helper->asset($article, 'imageFile');

    //         $data[] = [
    //             'id'         => $article->getId(),
    //             'title'      => $article->getTitle(),
    //             'categories' => $categories,
    //             'excerpt'    => $article->getExcerpt(),
    //             'url'        => $this->generateUrl('article', ['id' => $article->getId()]),
    //             'thumbnail'  => $imagineCacheManager->getBrowserPath($imagePath, 'article_thumbnail'),
    //         ];
    //     }

    //     return new JsonResponse($data);
    // }
}
