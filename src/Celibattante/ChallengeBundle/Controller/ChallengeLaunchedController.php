<?php

namespace Celibattante\ChallengeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Celibattante\ChallengeBundle\Entity\ChallengeLaunched;

class ChallengeLaunchedController extends Controller
{

	/**
     * @Route("/challenge/launched/upload")
     * @Template()
     */
	public function createAction() {
		$document = new ChallengeLaunched;
        $form = $this->createFormBuilder($document)
            ->add('description')
            ->add('creation_date')
            ->add('count')
            ->add('file')
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
        } else {

        }


        return new Response(); 
	}

	public function listAction() {

	}
}