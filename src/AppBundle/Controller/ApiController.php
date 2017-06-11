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
}
