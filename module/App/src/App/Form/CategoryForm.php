<?php
namespace App\Form;

use Zend\Form\Element\Select;
use Zend\Form\Form;
use VMBFormFieldsValidator\Form\FormFilter;

class CategoryForm extends Form
{
    public function __construct($name = null, array $options = array())
    {
        parent::__construct('categoryForm', $options);
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new FormFilter(array(
            'fieldsRequired' => array(
                'category_name' => 'Categoria'
            )
        )));

        //Client Fields
        $this->add(array(
            'type' => 'hidden',
            'name' => 'category_id',
            'attributes' => array(
                'id' => 'category_id'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'category_name',
            'options' => array(
                'label' => 'Categoria'
            ),
            'attributes' => array(
                'id' => 'category_name',
                'class' => 'form-control',
                'placeholder' => 'Nome da categoria'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'category_parent',
            'options' => array(
                'label' => 'Categoria Pai',
                'empty_option' => 'Selecione a categoria pai',
                'value_options' => $options,
            ),
            'attributes' => array(
                'id' => 'category_parent',
                'class' => 'form-control',
            )
        ));
        
        $this->getInputFilter()->get('category_parent')->setRequired(false);
        $this->getInputFilter()->get('category_parent')->setAllowEmpty(true);

        //csrf
        $this->add(array(
            'type' => 'Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));

        //button
        $this->add(array(
            'type' => 'Zend\Form\Element\Submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Cadastrar categoria',
                'class' => 'btn btn-success'
            )
        ));
    }
}