<?php
namespace App\Service;

use Doctrine\ORM\EntityManager;

class ProductService extends AbstractService
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->em = $em;
        $this->entity = 'App\Entity\Product';
    }

    public function store(array $data, $flush = true)
    {
        if (!isset($data['product_photo_1']) || $data['product_photo_1']['name'] == null) {
            throw new \Exception("Selecione pelomenos 1 imagem para o produto");
        }
        $upload = new MoveUploadService($data['product_photo_1'], __DIR__ . '/../../../../../public/products/');
        $path = explode("/", $upload->upload()['tmp_name']);
        $data['product_photo_1'] = '/products/' . $path[count($path) - 1];

        if ($data['product_photo_2']) {
            $upload = new MoveUploadService($data['product_photo_2'], __DIR__ . '/../../../../../public/products/');
            $path = explode("/", $upload->upload()['tmp_name']);
            $data['product_photo_2'] = '/products/' . $path[count($path) - 1];
        }

        if ($data['product_photo_3']) {
            $upload = new MoveUploadService($data['product_photo_3'], __DIR__ . '/../../../../../public/products/');
            $path = explode("/", $upload->upload()['tmp_name']);
            $data['product_photo_3'] = '/products/' . $path[count($path) - 1];
        }

        if ($data['product_photo_4']) {
            $upload = new MoveUploadService($data['product_photo_4'], __DIR__ . '/../../../../../public/products/');
            $path = explode("/", $upload->upload()['tmp_name']);
            $data['product_photo_4'] = '/products/' . $path[count($path) - 1];
        }

        if ($data['product_photo_5']) {
            $upload = new MoveUploadService($data['product_photo_5'], __DIR__ . '/../../../../../public/products/');
            $path = explode("/", $upload->upload()['tmp_name']);
            $data['product_photo_5'] = '/products/' . $path[count($path) - 1];
        }

        $data['category'] = $this->em->getRepository('App\Entity\Category')->find($data['category']);

        $product = parent::store($data);
        return $product;
    }
}