<?php

namespace Celibattante\ChallengeBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Celibattante\ChallengeBundle\Entity\ChallengeLaunched;
use Celibattante\ChallengeBundle\Entity\ChallengeRaised;
use Celibattante\ChallengeBundle\Entity\ChallengeSuper;
use JMS\Serializer\SerializerBuilder;


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


    public function postChallengeLaunchedAction(Request $request)
    {
        $challengeLaunched = new ChallengeLaunched();
        $form = $this->createFormBuilder($challengeLaunched, array('csrf_protection' => false))
            ->add('title')
            ->add('file')
            ->getForm();
        ;

        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $challengeLaunched->upload();
            $em->persist($challengeLaunched);
            $em->flush();

            return $challengeLaunched;
        } else {
            $serializer = SerializerBuilder::create()->build();
            return $form->getErrors();
        }
    }

}