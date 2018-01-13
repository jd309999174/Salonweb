<?php
namespace Cosmetic\Feedbacks;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class FeedbacksForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('Feedbacks');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PrizeFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
     
        $this->add(array(
            'name' => 'treid',
            'type' => 'text',
            'options' => array(
                'label' => 'treid'
            ),
            'attributes' => array(
                'id'=>'treid',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'salbranch',
            'type' => 'text',
            'options' => array(
                'label' => 'salbranch'
            ),
            'attributes' => array(
                'id'=>'salbranch',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cosid',
            'type' => 'text',
            'options' => array(
                'label' => 'cosid'
            ),
            'attributes' => array(
                'id'=>'cosid',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'fbsurrounding',
            'type' => 'text',
            'options' => array(
                'label' => 'fbsurrounding'
            ),
            'attributes' => array(
                'id'=>'fbsurrounding',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'fbproduct',
            'type' => 'text',
            'options' => array(
                'label' => 'fbproduct'
            ),
            'attributes' => array(
                'id'=>'fbproduct',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'fbcosmetologist',
            'type' => 'text',
            'options' => array(
                'label' => 'fbcosmetologist'
            ),
            'attributes' => array(
                'id'=>'fbcosmetologist',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'fbadvise',
            'type' => 'Zend\Form\Element\Textarea',
           
            'attributes' => array(
                'id'=>'fbadvise',
                'class'=>"form-control",
                'maxlength' => 100,
                'placeholder'=>"评价与建议"
            )
        ));
        $this->add(array(
            'name' => 'fbadvise1',
            'type' => 'Zend\Form\Element\Textarea',
             
            'attributes' => array(
                'id'=>'fbadvise1',
                'class'=>"form-control",
                'maxlength' => 100,
                'placeholder'=>"评价与建议"
            )
        ));
        $this->add(array(
            'name' => 'fbadvise2',
            'type' => 'Zend\Form\Element\Textarea',
             
            'attributes' => array(
                'id'=>'fbadvise2',
                'class'=>"form-control",
                'maxlength' => 100,
                'placeholder'=>"评价与建议"
            )
        ));
        
        
        
      
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => '提交',
                'class' => 'btn btn-primary btn-lg btn-block',
                'id'=>'fbsubmit'
            )
        ));
    }
}