<?php
namespace Cosmetic\Tip;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class TipForm extends Form
{
    
    public function __construct($name = null, $options = array())
    {
        parent::__construct('tip');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new TaskFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'cusid',
            'type' => 'text',
            'attributes' => array(
                'id' => 'cusid',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cusname',
            'type' => 'text',
            'attributes' => array(
                'id' => 'cusname',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cusphoto',
            'type' => 'text',
            'attributes' => array(
                'id' => 'cusphoto',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'cosid',
            'type' => 'text',
            'attributes' => array(
                'id' => 'cosid',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cosname',
            'type' => 'text',
            'attributes' => array(
                'id' => 'cosname',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cosphoto',
            'type' => 'text',
            'attributes' => array(
                'id' => 'cosphoto',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'text',
            'attributes' => array(
                'id' => 'salnumber',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'tipstate',
            'type' => 'text',
            'attributes' => array(
                'id' => 'tipstate',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'orderid',
            'type' => 'text',
            'attributes' => array(
                'id' => 'orderid',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'gmtclose',
            'type' => 'text',
            'attributes' => array(
                'id' => 'gmtclose',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'paymethod',
            'type' => 'text',
            'attributes' => array(
                'id' => 'paymethod',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'payid',
            'type' => 'text',
            'attributes' => array(
                'id' => 'payid',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'tipmoney',
            'type' => 'text',
            'attributes' => array(
                'id' => 'tipmoney',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Go',
                'class' => 'btn btn-primary'
            )
        ));
    }
}