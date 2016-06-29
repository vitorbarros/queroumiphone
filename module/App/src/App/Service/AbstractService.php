<?php
namespace App\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

class AbstractService implements InterfaceService
{

    /**
     * @var EntityManager
     */
    private $em;

    protected $entity;

    public function __construct(EntityManager $em)
    {
        if (!$this instanceof InterfaceService) {
            throw new \Exception("InterfaceService must be implemented");
        }

        if (null === $this->em) {
            $this->em = $em;
        }

    }

    /**
     * @param array $data
     * @param $flush
     * @return mixed
     * @throws \Exception
     */
    public function store(array $data, $flush = true)
    {

        try {

            $entity = new $this->entity($data);
            $this->em->persist($entity);
            if ($flush) {
                $this->em->flush();
            }
            return $entity;

        } catch (\Exception $e) {
            throw $e;
        }

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

        try {

            $entity = $this->em->getReference($this->entity, $id);
            (new Hydrator\ClassMethods())->hydrate($data, $entity);
            $this->em->persist($entity);
            if ($flush) {
                $this->em->flush();
            }
            return $entity;

        } catch (\Exception $e) {
            throw $e;
        }

    }

}