<?php

namespace Celibattante\UploadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Celibattante\UploadBundle\Entity\Upload;


class UploadController extends Controller
{
    /**
     * @Route("/upload")
     * @Template()
     */
public function uploadAction()
{
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
