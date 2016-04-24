<?php
namespace Client\Controller;

use Client\Form\ClientForm;
use Client\Service\ClientService;
use Client\Traits\FormAlert;
use Client\Traits\FormFields;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class ClientController extends AbstractActionController
{

    /**
     * Trait
     */
    use FormAlert;
    use FormFields;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct(
        EntityManager $em,
        ClientService $clientService
    )
    {
        $this->em = $em;
        $this->clientService = $clientService;
    }

    /**
     * @return ViewModel
     */
    public function createAction()
    {
        $clientForm = new ClientForm();
        return new ViewModel(array('form' => $clientForm));
    }

    /**
     * @return JsonModel
     */
    public function storeAction()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();

        $clientForm = new ClientForm();

        if ($request->isPost()) {

            $data = $request->getPost()->toArray();
            $clientForm->setData($data);

            if ($clientForm->isValid()) {
                try {
                    $this->clientService->store($data);
                    return new JsonModel(array('messages' => 'Cadastro realizado com sucesso'));
                } catch (\Exception $e) {
                    $response->setStatusCode(400);
                    return new JsonModel(array('messages' => $e->getMessage()));
                }
            }
            $response->setStatusCode(400);
            return new JsonModel(array(
                'messages' => $this->formatAlert($clientForm->getMessages()),
                'fields' => $this->fields($clientForm->getMessages())
            ));
        }
    }

}