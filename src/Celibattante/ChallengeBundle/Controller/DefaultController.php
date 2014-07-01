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
        var_dump(posix_getpwuid(posix_geteuid()));
        exit();
        return ;
        $challengeLaunched = new ChallengeLaunched();
        $form = $this->createFormBuilder($challengeLaunched, array('csrf_protection' => false))
            ->add('title')
            ->add('file')
            ->getForm();
        ;

        return array('form' => $form->createView());
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
        return new Response($reports);

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
        if (!$user) {
            throw $this->createNotFoundException('Aucun utilisateur trouvé');
        }

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($user, 'json');
        return new Response($reports);

    }

    /**
    * @Route("/listChallengeLaunched")
    * @Template()
    */
    public function listChallengeLaunchedAction()
    {

        $challengeLaunched = $this->getDoctrine()
            ->getRepository('CelibattanteChallengeBundle:ChallengeLaunched')
            ->findBy(
                array('user_id' => '')
                )
            ->getRepository('CelibattanteUserBundle:User')
            ->findBy(
                array('id' => ''),
                array('genre' => 'F')
              );
        if (!$challengeLaunched) {
            throw $this->createNotFoundException('Aucun utilisateur trouvé');
        }

        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize($challengeLaunched, 'json');
        return new Response($reports);

    }
}
