<?php
namespace Cosmetic\Chatmodule;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;


class ChatmoduleForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('chatmodule');
        
        $this->setAttribute('method', 'post');
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'sendid',
            'type' => 'text',
            'attributes' => array(
                'id' => 'sendid',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'receiveid',
            'type' => 'text',
            'attributes' => array(
                'id' => 'receiveid',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'chatword',
            'type' => 'text',
            'attributes' => array(
                'id' => 'chatword',
                'maxlength' => 1000
            )
        ));
      
        $this->add(array(
            'name' => 'chatpicture',
            'type' => 'file',
            'attributes' => array(
                'id' => 'chatpicture',
                'onchange'=>'uploadpicture()',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'currentstate',
            'type' => 'text',
            'attributes' => array(
                'id' => 'chatstate',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'currentip',
            'type' => 'text',
            'attributes' => array(
                'id' => 'chatstate',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'id'=>'picturesubmit',
                'value' => 'Go',
                'class' => 'btn btn-primary'
            )
        ));
    }
}