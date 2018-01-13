<?php
namespace Cosmetic\Salonbutton;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class SalonbuttonForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('salonbutton');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PromotionFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'sbid',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'salonbutton',
            'type' => 'text',
            'options' => array(
                'label' => '按钮名'
            ),
            'attributes' => array(
                
                'maxlength' => 100
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