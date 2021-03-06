<?php
namespace Client\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Client\Entity\Repository\ClientRepository")
 */
class Client
{
    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $clientId;

    /**
     * @var string
     *
     * @ORM\Column(name="client_name", type="string", length=255, nullable=false)
     */
    private $clientName;

    /**
     * @var string
     *
     * @ORM\Column(name="client_email", type="string", length=200, nullable=false)
     */
    private $clientEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="client_sexo", type="string", length=11, nullable=false)
     */
    private $clientSexo;

    /**
     * @var string
     *
     * @ORM\Column(name="client_facebook", type="string", length=11, nullable=false)
     */
    private $clientFacebook;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="client_birthday", type="datetime", nullable=false)
     */
    private $clientBirthday;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="client_created_at", type="datetime", nullable=false)
     */
    private $clientCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="client_updated_at", type="datetime", nullable=false)
     */
    private $clientUpdatedAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="user_id")
     */
    private $user;

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->clientCreatedAt = new \DateTime("now");
        $this->clientUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     * @return Client
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * @param string $clientName
     * @return Client
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientEmail()
    {
        return $this->clientEmail;
    }

    /**
     * @param string $clientEmail
     * @return Client
     */
    public function setClientEmail($clientEmail)
    {
        $this->clientEmail = $clientEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSexo()
    {
        return $this->clientSexo;
    }

    /**
     * @param string $clientSexo
     * @return Client
     */
    public function setClientSexo($clientSexo)
    {
        $this->clientSexo = $clientSexo;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientFacebook()
    {
        return $this->clientFacebook;
    }

    /**
     * @param string $clientFacebook
     * @return Client
     */
    public function setClientFacebook($clientFacebook)
    {
        $this->clientFacebook = $clientFacebook;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getClientBirthday()
    {
        return $this->clientBirthday;
    }

    /**
     * @param \DateTime $clientBirthday
     * @return Client
     */
    public function setClientBirthday($clientBirthday)
    {
        $this->clientBirthday = $clientBirthday;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getClientCreatedAt()
    {
        return $this->clientCreatedAt;
    }

    /**
     * @param \DateTime $clientCreatedAt
     * @return Client
     */
    public function setClientCreatedAt($clientCreatedAt)
    {
        $this->clientCreatedAt = $clientCreatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getClientUpdatedAt()
    {
        return $this->clientUpdatedAt;
    }

    /**
     * @param \DateTime $clientUpdatedAt
     * @return Client
     */
    public function setClientUpdatedAt($clientUpdatedAt)
    {
        $this->clientUpdatedAt = $clientUpdatedAt;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Client
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
    
    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'client_id' => $this->getClientId(),
            'client_name' => $this->getClientName(),
            'client_email' => $this->getClientEmail(),
            'client_birthday' => $this->getClientBirthday(),
            'client_created_at' => $this->getClientCreatedAt(),
            'client_updated_at' => $this->getClientUpdatedAt(),
            'user' => $this->getUser()->toArray()
        );
    }

}

