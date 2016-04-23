<?php
namespace Client\Controller;

use Client\Form\ClientForm;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ClientController extends AbstractActionController
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var ClientForm
     */
    private $clientForm;

    public function __construct(EntityManager $em)
    {
        if (null === $this->clientForm) {
            $this->clientForm = new ClientForm();
        }
        $this->em = $em;
    }

    /**
     * @return ViewModel
     */
    public function createAction()
    {
        return new ViewModel(array('form' => $this->clientForm));
    }
}