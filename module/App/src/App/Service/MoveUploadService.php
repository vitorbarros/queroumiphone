<?php
namespace App\Service;

use Zend\Filter\File\Rename;

class MoveUploadService
{
    /**
     * @var array
     */
    private $file;

    /**
     * @var string
     */
    private $fullPath;

    public function __construct(array $file, $fullPath)
    {
        if (!isset($file['name']) || $file['name'] == null) {
            throw new \Exception("File name cannot be null");
        }
        $this->file = $file;
        $this->fullPath = $fullPath;
    }

    /**
     * @return array|string
     */
    public function upload()
    {
        $rename = new Rename(array(
            'target' => $this->fullPath . $this->file['name'],
            'randomize' => true
        ));
        return $rename->filter($this->file);
    }
}