<?php

namespace Celibattante\UserBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserRestController extends Controller
{
    public function getUserAction($username)
    {
        return 'user :' . $username;
        $user = $this->getRepository('UserBundle:User')->findOneByUsername($username);
        if (!is_object($user)) {
            throw $this->createNotFoundException();
        }
        return $user;
    }


    public function getMeAction(){
        $this->forwardIfNotAuthenticated();
        return $this->getUser();
    }

    public function postChallengeLaunchedAction(){
        
    }

}