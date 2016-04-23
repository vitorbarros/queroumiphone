<?php
namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Client\Entity\Repository\UserRepository")
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_username", type="string", length=200, nullable=false)
     */
    private $userUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=255, nullable=false)
     */
    private $userPassword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_created_at", type="datetime", nullable=false)
     */
    private $userCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_updated_at", type="datetime", nullable=false)
     */
    private $userUpdatedAt;

    public function __construct(array  $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->userCreatedAt = new \DateTime("now");
        $this->userUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserUsername()
    {
        return $this->userUsername;
    }

    /**
     * @param string $userUsername
     * @return User
     */
    public function setUserUsername($userUsername)
    {
        $this->userUsername = $userUsername;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * @param string $userPassword
     * @return User
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUserCreatedAt()
    {
        return $this->userCreatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getUserUpdatedAt()
    {
        return $this->userUpdatedAt;
    }

    /**
     * @return User
     */
    public function setUserUpdatedAt()
    {
        $this->userUpdatedAt = new \DateTime("now");
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'user_id' => $this->getUserId(),
            'user_username' => $this->getUserUsername(),
            'user_created_at' => $this->getUserCreatedAt(),
            'user_updated_at' => $this->getUserUpdatedAt()
        );
    }

}

