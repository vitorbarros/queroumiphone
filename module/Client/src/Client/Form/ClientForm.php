<?php
namespace Client\Form;

use Zend\Form\Form;
use VMBFormFieldsValidator\Form\FormFilter;

class ClientForm extends Form
{
    public function __construct($name = null, array $options = array())
    {
        parent::__construct('clientForm', $options);
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new FormFilter(array(
            'fieldsRequired' => array(
                'client_name' => 'Nome completo',
                'client_email' => 'E-mail',
                'client_cpf' => 'Cpf',
                'client_birthday' => 'Data de nascimento',
                'user_password' => 'Senha',
                'user_password_confirm' => 'Confirmar senha'
            ),
            'passwordValidator' => array(
                'password' => array(
                    'name' => 'user_password',
                    'label' => 'Senha'
                ),
                'confirmation' => array(
                    'name' => 'user_password_confirm',
                    'label' => 'Confirmar senha'
                )
            )
        )));

        //Client Fields
        $this->add(array(
            'type' => 'hidden',
            'name' => 'client_id',
            'attributes' => array(
                'id' => 'client_id'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'client_name',
            'options' => array(
                'label' => 'Nome completo'
            ),
            'attributes' => array(
                'id' => 'client_name',
                'class' => 'form-control',
                'placeholder' => 'Entre com o nome completo'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'client_email',
            'options' => array(
                'label' => 'E-mail'
            ),
            'attributes' => array(
                'id' => 'client_email',
                'class' => 'form-control',
                'placeholder' => 'Entre com o e-mail'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'client_cpf',
            'options' => array(
                'label' => 'Cpf'
            ),
            'attributes' => array(
                'id' => 'client_cpf',
                'class' => 'form-control',
                'placeholder' => 'Entre com o cpf'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'client_birthday',
            'options' => array(
                'label' => 'Data de nascimento',
            ),
            'attributes' => array(
                'id' => 'client_birthday',
                'class' => 'form-control',
                'placeholder' => 'Entre com a data de nascimento'
            )
        ));

        //user fields
        $this->add(array(
            'type' => 'password',
            'name' => 'user_password',
            'options' => array(
                'label' => 'Senha'
            ),
            'attributes' => array(
                'id' => 'user_password',
                'class' => 'form-control',
                'placeholder' => 'Entre com a senha'
            )
        ));

        $this->add(array(
            'type' => 'password',
            'name' => 'user_password_confirm',
            'options' => array(
                'label' => 'Confirmar senha'
            ),
            'attributes' => array(
                'id' => 'user_password',
                'class' => 'form-control',
                'placeholder' => 'Entre com a confirmação da senha'
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
                'value' => 'Cadastrar',
                'class' => 'btn btn-success'
            )
        ));

    }
}