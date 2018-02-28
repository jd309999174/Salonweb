<?php
namespace Cosmetic\Custombutton;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class CustombuttonForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('custombutton');

        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PromotionFilter());
        $this->setHydrator(new ClassMethods());

        $this->add(array(
            'name' => 'buttonid',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'buttonname',
            'type' => 'text',
            
            'attributes' => array(
                'maxlength' => 100
            )
        ));
      
        $this->add(array(
            'name' => 'buttonlink',
            'type' => 'text',
            
            'attributes' => array(
                'maxlength' => 100,
                'readonly'=>'readonly'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => '提交',
                'class' => 'btn btn-primary'
            )
        ));
    }
}