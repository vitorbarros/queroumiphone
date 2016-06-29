<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="App\Entity\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name", type="string", length=255, nullable=false)
     */
    private $categoryName;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_parent", type="integer")
     */
    private $categoryParent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="category_created_at", type="datetime", nullable=false)
     */
    private $categoryCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="category_updated_at", type="datetime", nullable=false)
     */
    private $categoryUpdatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="category_slug", type="string", nullable=false)
     */
    private $categorySlug;


    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->categoryCreatedAt = new \DateTime("now");
        $this->categoryUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     * @return Category
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * @param string $categoryName
     * @return Category
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
        return $this;
    }

    /**
     * @return int
     */
    public function getCategoryParent()
    {
        return $this->categoryParent;
    }

    /**
     * @param int $categoryParent
     * @return Category
     */
    public function setCategoryParent($categoryParent)
    {
        $this->categoryParent = $categoryParent;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCategoryCreatedAt()
    {
        return $this->categoryCreatedAt;
    }

    /**
     * @param \DateTime $categoryCreatedAt
     * @return Category
     */
    public function setCategoryCreatedAt($categoryCreatedAt)
    {
        $this->categoryCreatedAt = $categoryCreatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCategoryUpdatedAt()
    {
        return $this->categoryUpdatedAt;
    }

    /**
     * @param \DateTime $categoryUpdatedAt
     * @return Category
     */
    public function setCategoryUpdatedAt($categoryUpdatedAt)
    {
        $this->categoryUpdatedAt = $categoryUpdatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCategorySlug()
    {
        return $this->categorySlug;
    }

    /**
     * @param \DateTime $categorySlug
     * @return Category
     */
    public function setCategorySlug($categorySlug)
    {
        $this->categorySlug = $categorySlug;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'category_id' => $this->getCategoryId(),
            'category_name' => $this->getCategoryName(),
            'category_created_at' => $this->getCategoryCreatedAt()->format('Y-m-d H:i'),
            'category_updated_at' => $this->getCategoryUpdatedAt()->format('Y-m-d H:i'),
            'category_parent' => $this->getCategoryParent(),
            'category_slug' => $this->getCategorySlug()
        );
    }
}

