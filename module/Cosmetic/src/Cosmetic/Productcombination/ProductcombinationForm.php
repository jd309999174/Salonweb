<?php
namespace Cosmetic\Productcombination;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class ProductcombinationForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct('Productcombination');
    
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PromotionFilter());
        $this->setHydrator(new ClassMethods());
       
        $this->add(array(
            'name' => 'productcombinationid',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'prodid',
            'type' => 'text',
            'options' => array(
                'label' => '产品id'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'text',
            'options' => array(
                'label' => '美容院编号'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'productcombinationprice',
            'type' => 'text',
            'options' => array(
                'label' => '组合分类价格'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'productcombinationpicture',
            'type' => 'text',
            'options' => array(
                'label' => '组合分类图'
            ),
            'attributes' => array(
                'id'=>'productcombinationpicture',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'productcombinationname',
            'type' => 'text',
            'options' => array(
                'label' => '组合分类名'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'id'=>'submit',
                'type' => 'submit',
                'value' => '提交',
                'class' => 'btn btn-primary'
            )
        ));
    }
}