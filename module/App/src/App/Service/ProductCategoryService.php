<?php
namespace App\Service;

use Doctrine\ORM\EntityManager;

class ProductCategoryService extends AbstractService
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'App\Entity\Category';
        $this->em = $em;
    }

    /**
     * @param array $data
     * @param bool $flush
     * @return mixed
     * @throws \Exception
     */
    public function store(array $data, $flush = true)
    {
        $slug = new SlugManager($this->em);
        $data['category_slug'] = $slug->getSlug($data['category_name'], 'App\\Entity\\Category', 'categorySlug');
        $category = parent::store($data);
        return $category;
    }

    /**
     * @param $id
     * @param array $data
     * @param bool $flush
     * @return bool|\Doctrine\Common\Proxy\Proxy|null|object
     * @throws \Exception
     */
    public function update($id, array $data, $flush = true)
    {   
        $slug = new SlugManager($this->em);
        $data['category_slug'] = $slug->getSlug($data['category_name'], 'App\\Entity\\Category', 'categorySlug');
        $category = parent::update($id, $data);
        return $category;
    }
}