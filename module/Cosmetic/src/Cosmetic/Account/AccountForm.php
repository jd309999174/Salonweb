<?php
namespace Cosmetic\Account;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class AccountForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('Account');
        
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new AccountFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'accountid',
            'type' => 'hidden'
        ));
     
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'text',
            'attributes' => array(
                'class'=>'form-control',
                'maxlength' => 100,
                'id'=>'salnumber'
            )
        ));
        $this->add(array(
            'name' => 'salaccount',
            'type' => 'text',
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>'请输入账号',
                'maxlength' => 100,
                'id'=>'salaccount'
            )
        ));
        $this->add(array(
            'name' => 'salpassword',
            'type' => 'password',
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>'请输入密码',
                'maxlength' => 100,
                'id'=>'salpassword'
            )
        ));
        $this->add(array(
            'name' => 'salbossname',
            'type' => 'text',
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>'请输入院长姓名',
                'maxlength' => 100,
                'id'=>'salbossname'
            )
        ));
        $this->add(array(
            'name' => 'salbossphone',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100,
                'class'=>'form-control',
                'placeholder'=>'请输入手机号',
                'id'=>'salbossphone'
            )
        ));
        $this->add(array(
            'name' => 'salbossphoto',
            'type' => 'text',
            'attributes' => array(
                'class'=>'form-control',
                'maxlength' => 100,
                'id'=>'salbossphoto'
            )
        ));
        $this->add(array(
            'name' => 'salbossphotof',
            'type' => 'file',
            'attributes' => array(
                'class'=>'form-control',
                'id'=>'salbossphotof',
                'onchange'=>'change("salbossphotof","salbossphoto")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'salbossidentity',
            'type' => 'text',
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>'请输入身份证号',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'salname',
            'type' => 'text',
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>'请输入美容院名称',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'saladdress',
            'type' => 'text',
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>'请输入美容院地址',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'sallicense',
            'type' => 'text',
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>'请输入营业执照统一社会信用代码',
                'maxlength' => 100
            )
        ));
        
        
      
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => '提交',
                'class' => 'btn btn-primary',
                'id' => 'submit'
            )
        ));
    }
}