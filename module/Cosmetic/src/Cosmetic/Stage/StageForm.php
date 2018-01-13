<?php
namespace Cosmetic\Stage;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class StageForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('stage');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new StageFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'staid',
            'type' => 'hidden'
        ));
       
        $this->add(array(
            'name' => 'treid',
            'type' => 'text',
            'options' => array(
                'label' => '疗程id'
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
            'name' => 'cosid',
            'type' => 'text',
            'options' => array(
                'label' => '美容师id'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'stascore',
            'type' => 'text',
            'options' => array(
                'label' => '服务评分'
            ),
            'attributes' => array(
                
                'maxlength' => 100
            )
        ));
       
        $this->add(array(
            'name' => 'stacomment',
            'type' => 'text',
            'options' => array(
                'label' => '评价'
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