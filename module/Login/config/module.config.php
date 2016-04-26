<?php
namespace Login;

return array(
    'router' => array(
        'routes' => array(
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
        ),
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
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
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
