<?php
namespace Login\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Login\Form\LoginForm;
use Client\Traits\WorkSession;

class LoginController extends AbstractActionController
{

    /**
     * Traits
     */
    use WorkSession;

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $form = new LoginForm();
        return new ViewModel(array('form' => $form));
    }

    /**
     * @return JsonModel
     */
    public function authAction()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();

        if ($request->isPost()) {

            $dados = $request->getPost()->toArray();
            $auth = new AuthenticationService();

            $sessionStorage = new SessionStorage("Login");

            $auth->setStorage($sessionStorage);

            $authAdapter = $this->getPluginManager()->getServiceLocator()->get('Login\Auth\Adapter');
            $authAdapter->setUsername($dados['login']);
            $authAdapter->setPassword($dados['password']);

            $result = $auth->authenticate($authAdapter);

            if ($result->isValid()) {

                $sessionStorage->write($auth->getIdentity()['user'], null);
                $route = $this->getSession('redirect');

                if (!empty($route)) {
                    return new JsonModel(array('redirect' => $route['redirect_to']));
                } else {
                    return new JsonModel(array('redirect' => '/app/client/my-account'));
                }

            } else {
                $response->setStatusCode(401);
                return new JsonModel(array('messages' => 'Usuário ou senha inválidos'));
            }
        }
    }
}
