<?php
namespace App\Traits;

trait FormFields
{
    public function fields(array $formMessages)
    {
        $fields = array();

        foreach ($formMessages as $k => $v) {

            if ($k != 'csrf') {
                $fields[] = $k;
            }
        }
        return $fields;
    }
}