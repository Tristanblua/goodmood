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
        $user = $this->getRepository('UserBundle:User')->findOneByUsername($username);

        if(!is_object($user)){
            throw $this->createNotFoundException();
        }

        return $user;
    }

    public function getMeAction() {
        $user = $this->get('security.context')->getToken()->getUser();

        if ($user) {
            return $user;
        }

        return new JsonResponse(array(
            'message' => 'Vous n\'êtes pas identifié'
        ));

    }

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


}