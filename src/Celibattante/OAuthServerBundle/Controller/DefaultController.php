<?php

namespace Celibattante\OAuthServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/createClient")
     * @Template()
     */
    public function createClientAction($name)
    {
        $clientManager = $this->get('fos_oauth_server.client_manager.default');
		$client = $clientManager->createClient();
		$client->setRedirectUris(array('http://www.example.com'));
		$client->setAllowedGrantTypes(array('token', 'authorization_code'));
		$clientManager->updateClient($client);

		return $this->redirect($this->generateUrl('fos_oauth_server_authorize', array(
		    'client_id'     => $client->getPublicId(),
		    'redirect_uri'  => 'http://www.example.com',
		    'response_type' => 'code'
		)));
    }
}
