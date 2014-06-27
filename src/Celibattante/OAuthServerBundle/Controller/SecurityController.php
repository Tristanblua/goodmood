<?php

namespace Celibattante\OAuthServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
	 /**
     * @Route("/oauth/v2/auth_login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            $error = $error->getMessage();
        }
        
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        return $this->render('AcmeOAuthServerBundle:Security:login.html.php', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
    
    /**
     * @Route("/oauth/v2/auth_login_check")
     * @Template()
     */
    public function loginCheckAction(Request $request)
    {
        
    }
}
