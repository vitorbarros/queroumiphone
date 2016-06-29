<?php
namespace App\Controller;

use App\Form\ProductForm;
use App\Service\ProductService;
use App\Traits\FormAlert;
use App\Traits\FormFields;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class ProductController extends AbstractActionController
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
     * @var ProductService
     */
    private $service;
    /**
     * @var ProductForm
     */
    private $form;

    /**
     * ProductController constructor.
     * @param EntityManager $em
     * @param ProductService $service
     * @param ProductForm $form
     */
    public function __construct(
        EntityManager $em,
        ProductService $service,
        ProductForm $form
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

    public function storeAction()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();

        if ($request->isPost()) {

            $data = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
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
}