<?php
namespace App\Controller;

use App\Entity\Category;
use App\Service\ProductCategoryService;
use App\Form\CategoryForm;
use App\Traits\FormAlert;
use App\Traits\FormFields;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class ProductCategoryController extends AbstractActionController
{
    /**
     * Traits
     */
    use FormAlert;
    use FormFields;

    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var ProductCategoryService
     */
    private $service;
    /**
     * @var CategoryForm
     */
    private $form;

    /**
     * ProductCategoryController constructor.
     * @param EntityManager $em
     * @param ProductCategoryService $service
     * @param CategoryForm $form
     */
    public function __construct(
        EntityManager $em,
        ProductCategoryService $service,
        CategoryForm $form
    )
    {
        $this->em = $em;
        $this->service = $service;
        $this->form = $form;
    }

    public function createAction()
    {
        return new ViewModel(array(
            'form' => $this->form
        ));
    }

    /**
     * @return JsonModel
     */
    public function storeAction()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();

        if ($request->isPost()) {

            $data = $request->getPost()->toArray();
            $this->form->setData($data);

            if ($this->form->isValid()) {
                try {
                    $this->service->store($data);
                    return new JsonModel(array('messages' => 'Cadastro realizado com sucesso'));
                } catch (\Exception $e) {
                    $response->setStatusCode(400);
                    return new JsonModel(array('messages' => $e->getMessage()));
                }
            }
            $response->setStatusCode(400);
            return new JsonModel(array(
                'messages' => $this->formatAlert($this->form->getMessages()),
                'fields' => $this->fields($this->form->getMessages())
            ));
        }
    }

    public function listAction()
    {
        $id = $this->params('id', 0);
        $category = $this->em->getRepository('App\Entity\Category')->find($id);
        if ($category instanceof Category) {
            $this->form->setData($category->toArray());
            return new ViewModel(array(
                'form' => $this->form
            ));
        }
        $categories = $this->em->getRepository('App\Entity\Category')->findAll();
        return new ViewModel(array(
            'categories' => $categories
        ));
    }

    /**
     * @return JsonModel
     * @throws \Doctrine\ORM\ORMException
     */
    public function updateAction()
    {
        $response = $this->getResponse();
        $request = $this->getRequest();
        $messages = null;

        if ($request->isPost()) {

            $data = $request->getPost()->toArray();
            $this->form->setData($data);

            if ($this->form->isValid()) {
                try {
                    $this->service->update($data['category_id'], $data);
                    return new JsonModel(array(
                            'redirect' => $this->url()->fromRoute('default_route', array('controller' => 'category', 'action' => 'list')))
                    );
                } catch (\Exception $e) {
                    $response->setStatusCode(400);
                    return new JsonModel(array('messages' => $e->getMessage()));
                }
            }
            $response->setStatusCode(400);
            return new JsonModel(array(
                    'messages' => $this->formatAlert($this->form->getMessages()),
                    'fields' => $this->fields($this->form->getMessages()))
            );
        }
    }

    /**
     * @return JsonModel
     */
    public function getAction()
    {
        $id = $this->params('id', 0);
        $categories = $this->em->getRepository('App\Entity\Category')->findToFormProduct($id);
        return new JsonModel(array('categories' => $categories));
    }
}