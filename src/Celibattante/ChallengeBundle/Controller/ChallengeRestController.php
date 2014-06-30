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


    public function postChallengeLaunchedAction()
    {
        $challengeLaunched = new ChallengeLaunched();
        $form = $this->createFormBuilder($challengeLaunched)
            ->add('title')
            ->add('file')
            ->getForm();
        ;

        if ($this->getRequest()->isMethod('POST')) {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($challengeLaunched);
                $em->flush();

                return $challengeLaunched;
            } else {
                $serializer = JMS\Serializer\SerializerBuilder::create()->build();
                $jsonError = $serializer->serialize($form->getErrors(), 'json');
                return $jsonError;
            }
        } else  {
            throw $this->createNotFoundException();
        }
    }

}