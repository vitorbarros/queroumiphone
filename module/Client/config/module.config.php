<?php
namespace Client;

use Client\Controller\ClientController;

return array(
    'router' => array(
        'routes' => array(
            'default_route' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '[/:controller[/:action]][/:id]',
                    'defaults' => array(
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'client' => function ($sm) {
                return new ClientController($sm->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
            },
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
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
