<?php

namespace Celibattante\ChallengeBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Celibattante\ChallengeBundle\Entity\ChallengeLaunched;
use Celibattante\ChallengeBundle\Entity\ChallengeRaised;
use Celibattante\ChallengeBundle\Entity\ChallengeSuper;

class ChallengeRestController extends Controller
{

	public function getChallengeLaunchedAction(){
        $ChallengeLaunched = $this->getDoctrine()->getRepository('ChallengeBundle:ChallengeLaunched')->findAll();
        if (!is_array($ChallengeLaunched)) {
            throw $this->createNotFoundException();
        }
        return $ChallengeLaunched;
    }

    public function getChallengeRaisedAction(){
        $ChallengeRaised = $this->getDoctrine()->getRepository('ChallengeBundle:ChallengeRaised')->findByTitle("Numero 1");
        if (!is_array($ChallengeRaised)) {
            throw $this->createNotFoundException();
        }
        return $ChallengeRaised;
    }


        public function postChallengeLaunchedAction(){

            $men = $this->getDoctrine()->getRepository('CelibattanteUserBundle:User')->findByGenre("M");
            if (!is_array($men)) {
                throw $this->createNotFoundException();
            }
            return $men;

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