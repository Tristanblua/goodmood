<?php

namespace Celibattante\UserBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Celibattante\UserBundle\Entity\User;

class UserRestController extends Controller
{

    /**
   *
   * @param type $username
   *
   * @View(serializerGroups={"Default","Details"})
   */
    public function getUserAction($username){
        $user = $this->getDoctrine()->getRepository('CelibattanteUserBundle:User')->findOneByUsername($username);
        $user->calcAge();
        if(!is_object($user)){
            throw $this->createNotFoundException();
        }

        return $user;
    }


    /**
   *
   * @param type $username
   *
   * @View(serializerGroups={"Default"})
   */
    public function getMeAction() {
        $user = $this->getUser();

        if ($user) {
            return $user;
        }

        return new JsonResponse(array(
            'message' => 'Vous n\'êtes pas identifié'
        ));
    }

    /**
   *
   * @param type $username
   *
   * @View(serializerGroups={"Default"})
   */
    public function getUserMenAction(){
        $men = $this->getDoctrine()->getRepository('CelibattanteUserBundle:User')->findByGenre("M");
        if (!is_array($men)) {
            throw $this->createNotFoundException();
        }
        return $men;
    }

   /**
   * @param type $username
   *
   * @View(serializerGroups={"Default"})
   */
    public function getUserWomenAction(){
        $women = $this->getDoctrine()->getRepository('CelibattanteUserBundle:User')->findByGenre("F");
        if (!is_array($women)) {
            throw $this->createNotFoundException();
        }
        return $women;
    }


}