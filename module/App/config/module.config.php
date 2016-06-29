<?php
namespace App;

use App\Controller\DashboardController;
use App\Controller\ProductCategoryController;
use App\Controller\ProductController;
use App\Form\CategoryForm;

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
            'dashboard' => function ($sm) {
                return new DashboardController();
            },
            'category' => function ($sm) {
                return new ProductCategoryController(
                    $sm->getServiceLocator()->get('Doctrine\ORM\EntityManager'),
                    $sm->getServiceLocator()->get('App\Service\ProductCategoryService'),
                    $sm->getServiceLocator()->get('App\Form\CategoryForm')
                );
            },
            'product' => function ($sm) {
                return new ProductController(
                    $sm->getServiceLocator()->get('Doctrine\ORM\EntityManager'),
                    $sm->getServiceLocator()->get('App\Service\ProductService'),
                    $sm->getServiceLocator()->get('App\Form\ProductForm')
                );
            }
        )
    ),
    'module_layouts' => array(
        'Login' => 'layout/layout',
        'Client' => 'layout/layout',
        'App' => 'layout/layout-dashboard',
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
        'App_fixture' => __DIR__ . '/../src/App/Fixture',
    ),
);
