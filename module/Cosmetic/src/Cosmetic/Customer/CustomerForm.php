<?php
namespace Cosmetic\Customer;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class CustomerForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('customer');
        
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new CustomerFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'cusid',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'hidden'
        ));
       
       $this->add(array(
           'name' => 'cusphone',
           'type' => 'text',
         
           'attributes' => array(
               'placeholder'=>'请输入手机号',
               'class'=>'form-control',
               'id'=>'cusphone',
               'maxlength' => 100
           )
       ));
        $this->add(array(
            'name' => 'cuspassword',
            'type' => 'password',
            'attributes' => array(
                'placeholder'=>'请输入密码',
                'class'=>'form-control',
                'id'=>'cuspassword',
                'maxlength' => 100
            )
        ));
       
        
        $this->add(array(
            'name' => 'cusname',
            'type' => 'text',
          
            'attributes' => array(
                'placeholder'=>'请输入姓名',
                'class'=>'form-control',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'cusidentity',
            'type' => 'text',
           
            'attributes' => array(
                'class'=>'form-control',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'cusaddress',
            'type' => 'text',
          
            'attributes' => array(
                'class'=>'form-control',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cusphoto',
            'type' => 'text',
           
            'attributes' => array(
                'id'=>'cusphoto',
                'class'=>'form-control',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cusphotof',
            'type' => 'file',

            'attributes' => array(
                'class'=>'form-control',
                 'id'=>'cusphotof',
                'onchange'=>'change("cusphotof","cusphoto")',
                'maxlength' => 100
            )
        ));
      
        $this->add(array(
            'name' => 'cusbalance',
            'type' => 'text',
            
            'attributes' => array(
                'class'=>'form-control',
                'maxlength' => 100
            )
        ));
       
    
        
       

        $this->add(array(
            'name' => 'submit',
       
            'attributes' => array(
                'id'=>'submit',
                'type' => 'submit',
                'value' => '提交',
                'class' => 'btn btn-primary btn-lg btn-block'
            )
        ));
    }
}