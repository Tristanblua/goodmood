<?php

namespace Celibattante\UserBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Celibattante\UserBundle\Entity\User;

class UserRestController extends Controller
{
    public function getMenAction(){
        $men = $this->getDoctrine()->getRepository('CelibattanteUserBundle:User')->findByGenre("M");
        if (!is_array($men)) {
            throw $this->createNotFoundException();
        }
        return $men;
    }

    public function getWomenAction(){
        $women = $this->getDoctrine->getRepository('CelibattanteUserBundle:User')->findByGenre("F");
        if (!is_array($women)) {
            throw $this->createNotFoundException();
        }
        return $women;
    }
