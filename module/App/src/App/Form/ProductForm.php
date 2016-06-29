<?php
namespace App\Form;

use Zend\Form\Form;
use VMBFormFieldsValidator\Form\FormFilter;

class ProductForm extends Form
{
    public function __construct($name = null, array $options = array())
    {
        parent::__construct('productForm', $options);
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new FormFilter(array(
            'fieldsRequired' => array(
                'product_name' => 'Nome do produto',
                'product_description' => 'Descrição do produto',
                'category_1' => 'Categoria 1',
                'category_2' => 'Categoria 2',
                'category' => 'Categoria 3',
            )
        )));

        //Client Fields
        $this->add(array(
            'type' => 'hidden',
            'name' => 'product_id',
            'attributes' => array(
                'id' => 'product_id'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'product_name',
            'options' => array(
                'label' => 'Produto'
            ),
            'attributes' => array(
                'id' => 'product_name',
                'class' => 'form-control',
                'placeholder' => 'Nome do produto'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'product_description',
            'options' => array(
                'label' => 'Descrição'
            ),
            'attributes' => array(
                'id' => 'product_description',
                'class' => 'form-control',
                'placeholder' => 'Descrição do produto'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'category_1',
            'options' => array(
                'label' => 'Categoria 1',
                'empty_option' => 'Selecione a categoria',
                'value_options' => $options['category'],
                'disable_inarray_validator' => true
            ),
            'attributes' => array(
                'id' => 'category_1',
                'class' => 'form-control',
                'onchange' => 'getCategory(this.value, "category_2")'
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'category_2',
            'options' => array(
                'label' => 'Categoria 2',
                'empty_option' => 'Selecione a categoria',
                'value_options' => $options['all'],
                'disable_inarray_validator' => true
            ),
            'attributes' => array(
                'id' => 'category_2',
                'class' => 'form-control',
                'onchange' => 'getCategory(this.value, "category")'
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'category',
            'options' => array(
                'label' => 'Categoria 3',
                'empty_option' => 'Selecione a categoria',
                'value_options' => $options['all'],
                'disable_inarray_validator' => true
            ),
            'attributes' => array(
                'id' => 'category',
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\File',
            'name' => 'product_photo_1',
            'options' => array(
                'label' => 'Foto 1',
            ),
            'attributes' => array(
                'id' => 'product_photo_1',
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\File',
            'name' => 'product_photo_2',
            'options' => array(
                'label' => 'Foto 2',
            ),
            'attributes' => array(
                'id' => 'product_photo_2',
                'class' => 'form-control',
            )
        ));$this->add(array(
            'type' => 'Zend\Form\Element\File',
            'name' => 'product_photo_3',
            'options' => array(
                'label' => 'Foto 3',
            ),
            'attributes' => array(
                'id' => 'product_photo_3',
                'class' => 'form-control',
            )
        ));$this->add(array(
            'type' => 'Zend\Form\Element\File',
            'name' => 'product_photo_4',
            'options' => array(
                'label' => 'Foto 4',
            ),
            'attributes' => array(
                'id' => 'product_photo_4',
                'class' => 'form-control',
            )
        ));$this->add(array(
            'type' => 'Zend\Form\Element\File',
            'name' => 'product_photo_5',
            'options' => array(
                'label' => 'Foto 5',
            ),
            'attributes' => array(
                'id' => 'product_photo_5',
                'class' => 'form-control',
            )
        ));

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
                'value' => 'Cadastrar e anunciar',
                'class' => 'btn btn-success'
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Submit',
            'name' => 'submit_draft',
            'attributes' => array(
                'value' => 'Salvar rascunho',
                'class' => 'btn btn-success'
            )
        ));
    }
}