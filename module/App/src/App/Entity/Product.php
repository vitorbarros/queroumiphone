<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Client\Entity\Client;
use Zend\Stdlib\Hydrator;

/**
 * Product
 *
 * @ORM\Table(name="product", indexes={@ORM\Index(name="fk_product_client_idx", columns={"client_id"}), @ORM\Index(name="fk_product_category1_idx", columns={"category"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="App\Entity\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", length=45, nullable=false)
     */
    private $productName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="product_created_at", type="datetime", nullable=false)
     */
    private $productCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="product_updated_at", type="datetime", nullable=false)
     */
    private $productUpdatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="product_status", type="boolean", nullable=false)
     */
    private $productStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="product_description", type="text", length=65535, nullable=false)
     */
    private $productDescription;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="category_id")
     * })
     */
    private $category;

    /**
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client", referencedColumnName="client_id")
     * })
     */
    private $client;

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->productCreatedAt = new \DateTime("now");
        $this->productUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return Product
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     * @return Product
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getProductCreatedAt()
    {
        return $this->productCreatedAt;
    }

    /**
     * @param \DateTime $productCreatedAt
     * @return Product
     */
    public function setProductCreatedAt($productCreatedAt)
    {
        $this->productCreatedAt = $productCreatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getProductUpdatedAt()
    {
        return $this->productUpdatedAt;
    }

    /**
     * @param \DateTime $productUpdatedAt
     * @return Product
     */
    public function setProductUpdatedAt($productUpdatedAt)
    {
        $this->productUpdatedAt = $productUpdatedAt;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getProductStatus()
    {
        return $this->productStatus;
    }

    /**
     * @param boolean $productStatus
     * @return Product
     */
    public function setProductStatus($productStatus)
    {
        $this->productStatus = $productStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductDescription()
    {
        return $this->productDescription;
    }

    /**
     * @param string $productDescription
     * @return Product
     */
    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return Product
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return Product
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }
}

