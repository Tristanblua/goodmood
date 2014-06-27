<?php

namespace Celibattante\OAuthServerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CelibattanteOAuthServerBundle extends Bundle
{

	public function getParent()  
    {  
        return 'FOSOAuthServerBundle';  
    }  
}
