<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    protected function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    protected function prePersistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    protected function preUpdateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    protected function createArticleListQueryBuilder()
    {
        $checker = $this->get('security.authorization_checker');
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Article');

        if ($checker->isGranted('ROLE_ADMIN')) {
            $query = $repository->createQueryBuilder('a')->getQuery();
        } else {
            $user = $this->getUser();
            $query = $repository->createQueryBuilder('a')
                ->where('a.author = :author_id')
                ->setParameter('author_id', $user->getId())
                ->getQuery();
        }

        return $query;
    }

    public function listUserAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return parent::listAction();
    }

    public function newUserAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return parent::newAction();
    }

    public function editUserAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return parent::editAction();
    }

    public function showUserAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return parent::showAction();
    }

    public function deleteUserAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return parent::deleteAction();
    }
}