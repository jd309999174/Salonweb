<?php
namespace Cosmetic\Cosmetologist;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class CosmetologistForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('cosmetologist');
        
        $this->setAttribute('method', 'post');
        // $this->setInputFilter(new CosmetologistFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'cosid',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'hidden'
        ));
    
        $this->add(array(
            'name' => 'cosregdate',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'costoken',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'cosname',
            'type' => 'text',
            'options' => array(
                'label' => '姓名'
            ),
            'attributes' => array(
                'class'=>"form-control",
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cosbirthday',
            'type' => 'text',
            'options' => array(
                'label' => '生日'
            ),
            'attributes' => array(
                'class'=>"form-control",
                'maxlength' => 100,
                //'id'=>"datepicker"
            )
        ));
        $this->add(array(
            'name' => 'cosaddress',
            'type' => 'text',
            'options' => array(
                'label' => '地址'
            ),
            'attributes' => array(
                'class'=>"form-control",
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'cosphone',
            'type' => 'text',
            'options' => array(
                'label' => '手机号'
            ),
            'attributes' => array(
                'class'=>"form-control",
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cospassword',
            'type' => 'password',
            'options' => array(
                'label' => '密码'
            ),
            'attributes' => array(
                'class'=>"form-control",
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'cosphoto',
            'type' => 'text',
            'options' => array(
                'label' => '图片'
            ),
            'attributes' => array(
                'class'=>"form-control",
                'id'=>'cosphoto',
                'maxlength' => 100
            )
        ));
     
        
        $this->add(array(
            'name' => 'cosposition',
            'type' => 'text',
            'options' => array(
                'label' => '职务'
            ),
            'attributes' => array(
                'class'=>"form-control",
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cosspeciality',
            'type' => 'text',
            'options' => array(
                'label' => '专长'
            ),
            'attributes' => array(
                'class'=>"form-control",
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cosyears',
            'type' => 'text',
            'options' => array(
                'label' => '从业时长'
            ),
            'attributes' => array(
                'class'=>"form-control",
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cosidentity',
            'type' => 'text',
            'options' => array(
                'label' => '身份证号'
            ),
            'attributes' => array(
                'class'=>"form-control",
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'id'=>"submit",
                'type' => 'submit',
                'value' => '提交',
                'class' => 'btn btn-primary'
            )
        ));
    }
}