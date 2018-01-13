<?php
namespace Cosmetic\Saloncouponget;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class SaloncoupongetForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('saloncouponget');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PromotionFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'scgid',
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
                
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'sciid',
            'type' => 'text',
            'options' => array(
                'label' => '优惠券编号'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'scimoney',
            'type' => 'text',
            'options' => array(
                'label' => '优惠券金额'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'scgstate',
            'type' => 'text',
            'options' => array(
                'label' => '使用状态'
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