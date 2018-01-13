<?php
namespace Cosmetic\Signup;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;


class SignupForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('signup');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new TaskFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'pageid',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'pagename',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'cusid',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cusname',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cusphone',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cusphoto',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'id'=>'signupsubmit',
                'type' => 'submit',
                
                'class' => 'btn btn-primary'
            )
        ));
    }
}