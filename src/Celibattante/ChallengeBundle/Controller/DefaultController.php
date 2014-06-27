<?php

namespace Celibattante\ChallengeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Celibattante\ChallengeBundle\Entity\ChallengeLaunched;

class DefaultController extends Controller
{
    
    /**
     * @Route("/upload")
     * @Template()
     */
    public function uploadAction()
    {   
        $document = new Upload;
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
        //return array('form' => $form->createView());
    }

    /**
    * @Route("/listChallenge")
    * @Template()  
    */
    public function listChallengeAction()
    {
        $videos = $this->getDoctrine()
            ->getRepository('CelibattanteUploadBundle:Upload')
            ->findAll();

        if (!$videos) {
            throw $this->createNotFoundException('Aucune vidéo trouvée');
        }

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($videos, 'json');
        return new Response($reports); // should be $reports as $doctrine

        // $response = new JsonResponse();
        // $response->setData($videos);

        // return $response;
    }

    /**
    * @Route("/listMen")
    * @Template()  
    */
    public function listMenAction()
    {

        $user = $this->getDoctrine()
            ->getRepository('CelibattanteUserBundle:User')
            ->findByGenre('M');
        //die("passe");
        if (!$user) {
            throw $this->createNotFoundException('Aucun utilisateur trouvé');
        }

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($user, 'json');
        return new Response($reports); // should be $reports as $doctrine

    }

    /**
    * @Route("/listWomen")
    * @Template()
    */
    public function listWomenAction()
    {

        $user = $this->getDoctrine()
            ->getRepository('CelibattanteUserBundle:User')
            ->findByGenre('F');
        //die("passe");
        if (!$user) {
            throw $this->createNotFoundException('Aucun utilisateur trouvé');
        }

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($user, 'json');
        return new Response($reports); // should be $reports as $doctrine

    }
}
