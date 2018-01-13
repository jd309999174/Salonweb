<?php
namespace Cosmetic\Prize;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class PrizeForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('prize');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PrizeFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'priid',
            'type' => 'hidden'
        ));
     
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'salname',
            'type' => 'text',
            'options' => array(
                'label' => '美院名'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'cusnumber',
            'type' => 'text',
            'options' => array(
                'label' => '用户编号'
            ),
            'attributes' => array(
                'maxlength' => 500
            )
        ));
        
        $this->add(array(
            'name' => 'cusname',
            'type' => 'text',
            'options' => array(
                'label' => '用户名'
            ),
            'attributes' => array(
                
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'prodnumber',
            'type' => 'text',
            'options' => array(
                'label' => '产品编号'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'prodtitle',
            'type' => 'text',
            'options' => array(
                'label' => '产品名'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
                
        $this->add(array(
            'name' => 'prodthumbnail',
            'type' => 'text',
            'options' => array(
                'label' => '产品图'
            ),
            'attributes' => array(
                
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'prodprice',
            'type' => 'text',
            'options' => array(
                'label' => '产品价格'
            ),
            'attributes' => array(
               
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'priget',
            'type' => 'text',
            'options' => array(
                'label' => '领奖日期'
            ),
            'attributes' => array(
                
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'pridate',
            'type' => 'text',
            'options' => array(
                'label' => '抽中日期'
            ),
            'attributes' => array(
                
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'priexpiration',
            'type' => 'text',
            'options' => array(
                'label' => '截止日期'
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