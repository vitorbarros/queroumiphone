<?php
namespace App\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findToForm()
    {
        $returnArrayData = array();
        $categories = $this->findAll();
        foreach ($categories as $category) {
            $returnArrayData[$category->getCategoryId()] = $category->getCategoryName();
        }
        return $returnArrayData;
    }

    public function findToFormProduct($id = 0)
    {
        $returnArrayData = array();
        $categories = $this->findByCategoryParent($id);
        foreach ($categories as $category) {
            $returnArrayData[$category->getCategoryId()] = $category->getCategoryName();
        }
        return $returnArrayData;
    }
}