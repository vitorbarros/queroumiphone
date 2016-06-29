<?php
namespace Login\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class LoginForm extends Form {

    public function __construct($name = null) {

        parent::__construct('login');

        //montando o atributo do form
        $this->setAttribute('method', 'post');

        //field de email
        $this->add(array(
            'name'  =>  'login',
            'options' => array(
                'type' => 'text',
                'label' => 'Usuário',
            ),
            'attributes' => array(
                'id' => 'login',
                'placeholder' => 'Nome de usuário',
                'class' => 'form-control',
            ),
        ));

        //field de password
        $this->add(array(
            'name' => 'password',
            'options' => array(
                'label' => 'Senha',
            ),
            'attributes' => array(
                'id' => 'password',
                'placeholder' => 'Senha',
                'class' => 'form-control',
                'type' => 'password',
            ),
        ));

        //csrf field
        $this->add(array(
            'type' => 'Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));

        //buttom
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'id'    => 'button-login',
                'value' => 'Login',
                'class' => 'btn btn-success',
            ),
        ));

    }

}

?>