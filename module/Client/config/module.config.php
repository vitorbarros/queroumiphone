<?php
namespace Client;

use Client\Controller\ClientController;

return array(
    'controllers' => array(
        'factories' => array(
            'client' => function ($sm) {
                return new ClientController(
                    $sm->getServiceLocator()->get('Doctrine\ORM\EntityManager'),
                    $sm->getServiceLocator()->get('Client\Service\ClientService')
                );
            },
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                ),
            ),
        ),
    ),
    'data-fixture' => array(
        'Client_fixture' => __DIR__ . '/../src/Client/Fixture',
    ),
);
