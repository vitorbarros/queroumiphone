<?php
namespace Login;

use Login\Auth\Adapter as AuthAdapter;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Login\Auth\Adapter' => function ($service) {
                    return new AuthAdapter($service->get('Doctrine\ORM\EntityManager'));
                },
            ),
        );
    }
}

