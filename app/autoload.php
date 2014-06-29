<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\ClassLoader\ApcUniversalClassLoader;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

if (!function_exists('intl_get_error_code')) {
    $universalLoader = new UniversalClassLoader();
	$universalLoader->registerNamespaces(array(
	    'FOS'    => __DIR__.'/../vendor/bundles',
	    'OAuth2' => __DIR__.'/../vendor/oauth2-php/lib',
	));

    $universalLoader->register();
}

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));


return $loader;
