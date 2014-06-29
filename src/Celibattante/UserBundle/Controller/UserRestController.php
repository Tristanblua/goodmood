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

    public function postChallengeLaunchedAction(){
        $request = $this->getRequest();
        echo "pass";
        var_dump($request);
        exit();
        $document = new Upload;
        $form = $this->createFormBuilder($document)
            ->add('title')
            ->add('file')
            ->add('text')
            ->getForm();

            if ($this->getRequest()->isMethod('POST')) {
                $form->bind($this->getRequest());
                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $document->upload();

                    $em->persist($document);
                    $em->flush();

                    $this->redirect($this->generateUrl("celibattante_upload_upload_upload"));
                }
            }



        return array('form' => $form->createView());
    }
}