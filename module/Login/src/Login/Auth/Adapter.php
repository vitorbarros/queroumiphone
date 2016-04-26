<?php
namespace Login\Auth;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Doctrine\ORM\EntityManager;

class Adapter implements AdapterInterface
{

    /**
     *
     * @var EntityManager
     */
    protected $em;
    
    protected $username;
    protected $password;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @see Zend\Authentication\Adapter\AdapterInterface
     */
    public function authenticate()
    {
        $repositoryUser = $this->em->getRepository('Client\Entity\User');
        $user = $repositoryUser->findByEmailAndPassword($this->getUsername(), $this->getPassword());

        if ($user) {
            return new Result(Result::SUCCESS, ['user' => $user], ['ok']);
        }
        return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, []);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

}