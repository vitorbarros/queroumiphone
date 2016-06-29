<?php
namespace App;

use App\Form\CategoryForm;
use App\Form\ProductForm;
use App\Service\ProductCategoryService;
use App\Service\ProductService;
use Client\Service\ClientService;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap($e)
    {
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function ($e) {
            $controller = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            $config = $e->getApplication()->getServiceManager()->get('config');
            if (isset($config['module_layouts'][$moduleNamespace])) {
                $controller->layout($config['module_layouts'][$moduleNamespace]);
            }
        }, 98);
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
                'Client\Service\ClientService' => function ($sm) {
                    return new ClientService($sm->get('Doctrine\ORM\EntityManager'));
                },
                'App\Service\ProductCategoryService' => function ($sm) {
                    return new ProductCategoryService($sm->get('Doctrine\ORM\EntityManager'));
                },
                'App\Service\ProductService' => function ($sm) {
                    return new ProductService($sm->get('Doctrine\ORM\EntityManager'));
                },
                'App\Form\CategoryForm' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $categories = $em->getRepository('App\Entity\Category')->findToForm();
                    return new CategoryForm(null, $categories);
                },
                'App\Form\ProductForm' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $categories  = array(
                        'category' => $em->getRepository('App\Entity\Category')->findToFormProduct(),
                        'all' => $em->getRepository('App\Entity\Category')->findToForm()
                    );
                    return new ProductForm(null, $categories);
                },
            )
        );
    }
}
