<?php
namespace App\Traits;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Session\Container;

trait WorkSession
{

    /**
     * @return mixed|null
     */
    public function userSession() {
        $auth = new AuthenticationService();
        $auth->setStorage(new SessionStorage("Login"));
        return $auth->getIdentity();
    }

    /**
     * @param $sessionName
     * @return mixed|null
     */
    public function getSession($sessionName) {
        $retorno = null;
        $session = new Container();
        if($session->offsetExists($sessionName)){
            $retorno = $session->offsetGet($sessionName);
        }
        return $retorno;
    }

    /**
     * @param array $data
     * @param $nome
     */
    public function writeSession(array $data, $nome) {
        $session = new Container();
        return $session->offsetSet($nome, $data);
    }

    /**
     * @param $sessionName
     * @return null|void
     */
    public function deleteSession($sessionName) {
        $retorno = null;
        $session = new Container();
        if($session->offsetExists($sessionName)){
            $retorno = $session->offsetUnset($sessionName);
        }
        return $retorno;
    }
}

?>