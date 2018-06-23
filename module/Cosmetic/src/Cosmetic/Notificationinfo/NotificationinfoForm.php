<?php
namespace Cosmetic\Notificationinfo;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;


class NotificationinfoForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('Notificationinfo');
        
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
                'id' => 'salnumber',
                'maxlength' => 100,
                'class'=>"form-control"
            )
        ));
        $this->add(array(
            'name' => 'nolink',
            'type' => 'text',
            
            'attributes' => array(
                'id' => 'nolink',
                'maxlength' => 100,
                'class'=>"form-control",
                'required'=>"required",
                'readonly'=>'readonly'
            )
        ));
        
        $this->add(array(
            'name' => 'notitle',
            'type' => 'text',
        
            'attributes' => array(
                'id' => 'notitle',
                'maxlength' => 30,
                'class'=>"form-control"
            )
        ));
        
        $this->add(array(
            'name' => 'nocontent',
            'type' => 'text',
        
            'attributes' => array(
                'id' => 'nocontent',
                'maxlength' => 100,
                'class'=>"form-control"
            )
        ));
       
        
        $this->add(array(
            'name' => 'submitname',
            'attributes' => array(
                'type' => 'submit',
                'class' => 'btn btn-primary'
            )
        ));
    }
}