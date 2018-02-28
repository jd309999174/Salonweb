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
            'options' => array(
                'label' => '用户编号'
            ),
            'attributes' => array(
                'maxlength' => 100,
                'class'=>'form-control'
            )
        ));
        $this->add(array(
            'name' => 'scirestriction',
            'type' => 'text',
            'options' => array(
                'label' => '使用限制'
            ),
            'attributes' => array(
                'maxlength' => 100,
                'class'=>'form-control'
            )
        ));
        $this->add(array(
            'name' => 'scimoney',
            'type' => 'text',
            'options' => array(
                'label' => '优惠券金额'
            ),
            'attributes' => array(
                'maxlength' => 100,
                'class'=>'form-control'
            )
        ));
        $this->add(array(
            'name' => 'sciavailable',
            'type' => 'text',
            'options' => array(
                'label' => '有效截止日期'
            ),
            'attributes' => array(
                'maxlength' => 100,
                'class'=>'form-control ui_timepicker'
            )
        ));
        $this->add(array(
            'name' => 'scitimes',
            'type' => 'text',
            'options' => array(
                'label' => '每人限领次数'
            ),
            'attributes' => array(
                'maxlength' => 100,
                'class'=>'form-control'
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