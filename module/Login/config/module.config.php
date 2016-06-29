<?php
namespace Login;

return array(
    'router' => array(
        'routes' => array(
            'auth' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/auth/verifyCredentials',
                    'defaults' => array(
                        'controller' => 'login',
                        'action'     => 'auth',
                    ),
                ),
            ),
            'login-view' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        'controller' => 'login',
                        'action'     => 'index',
                    ),
                ),
            ),
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'login' => 'Login\Controller\LoginController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'doctrine'  =>  array(
        'driver'    =>  array(
            __NAMESPACE__ . '_driver'  =>  array(
                'class' =>  'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' =>  'array',
                'paths' =>  array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'),
            ),
            'orm_default'   =>  array(
                'drivers'   =>  array(
                    __NAMESPACE__ . '\Entity'   =>  __NAMESPACE__ . '_driver',
                ),
            ),
        ),
    ),
);
