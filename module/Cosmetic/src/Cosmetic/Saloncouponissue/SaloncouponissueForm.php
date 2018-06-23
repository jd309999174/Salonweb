<?php
namespace Cosmetic\Saloncouponissue;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class SaloncouponissueForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('saloncouponissue');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PromotionFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'sciid',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'cusid',
            'type' => 'text',
            
            'attributes' => array(
                'placeholder'=>"请输入用户编号，默认为0，即所有顾客",
                'class'=>'form-control',
                'maxlength' => 10
            )
        ));
        $this->add(array(
            'name' => 'scirestriction',
            'type' => 'text',
            
            'attributes' => array(
                'placeholder'=>"请输入使用所需消费额",
                'class'=>'form-control',
                'maxlength' => 10
            )
        ));
        $this->add(array(
            'name' => 'scimoney',
            'type' => 'text',
            
            'attributes' => array(
                'placeholder'=>"请输入优惠券金额",
                'class'=>'form-control',
                'maxlength' => 10
            )
        ));
        $this->add(array(
            'name' => 'sciavailable',
            'type' => 'text',
            
            'attributes' => array(
                'placeholder'=>"有效截止日期",
                'class'=>'form-control ui_timepicker',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'scitimes',
            'type' => 'text',
            
            'attributes' => array(
                'placeholder'=>"每人限领次数",
                'class'=>'form-control',
                'maxlength' => 2
            )
        ));
        
        $this->add(array(
            'name' => 'submitname',
            'attributes' => array(
                'type' => 'submit',
                'value' => '提交',
                'class' => 'btn btn-primary'
            )
        ));
        
    }
}