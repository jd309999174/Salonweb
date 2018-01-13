<?php
namespace Cosmetic\Cusleveltype;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class CusleveltypeForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('cusleveltype');
        
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
            'name' => 'cuslevel',
            'type' => 'text',
        
            'attributes' => array(
                'id' => 'cuslevel',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'custype',
            'type' => 'text',
        
            'attributes' => array(
                'id' => 'custype',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'cussalonbranch',
            'type' => 'text',
        
            'attributes' => array(
                'id' => 'cussalonbranch',
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