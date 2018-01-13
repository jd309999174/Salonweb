<?php
namespace Cosmetic\Treatment;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class TreatmentForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('treatment');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PromotionFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'treid',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'cusid',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'prodid',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'productcombinationid',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'productcombinationname',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'couponidused',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'trecompleted',
            'type' => 'text',
            'options' => array(
                'label' => '完成度'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'treprice',
            'type' => 'text',
            'options' => array(
                'label' => '实际价格'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
       
        $this->add(array(
            'name' => 'trestate',
            'type' => 'text',
            'options' => array(
                'label' => '订单状态'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'treremark',
            'type' => 'text',
            'options' => array(
                'label' => '备注'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'productquantity',
            'type' => 'text',
            'options' => array(
                'label' => '数量'
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