<?php
namespace Cosmetic\Generallayout;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class GenerallayoutForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('generallayout');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new GenerallayoutFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'glid',
            'type' => 'hidden'
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
            'name' => 'cusnumber',
            'type' => 'text',
            'options' => array(
                'label' => '用户编号'
            ),
            'attributes' => array(
                'maxlength' => 100
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
            'name' => 'glpicture1',
            'type' => 'text',
            'options' => array(
                'label' => '图1'
            ),
            'attributes' => array(
                'maxlength' => 500
            )
        ));
        
        $this->add(array(
            'name' => 'glpicture2',
            'type' => 'text',
            'options' => array(
                'label' => '图2'
            ),
            'attributes' => array(
                'maxlength' => 500
            )
        ));
        
        
        $this->add(array(
            'name' => 'glpicture3',
            'type' => 'text',
            'options' => array(
                'label' => '图3'
            ),
            'attributes' => array(
                'maxlength' => 500
            )
        ));
        
        $this->add(array(
            'name' => 'glsrc1',
            'type' => 'text',
            'options' => array(
                'label' => '链接1'
            ),
            'attributes' => array(
                
                'maxlength' => 100
            )
        ));
         $this->add(array(
            'name' => 'glsrc2',
            'type' => 'text',
            'options' => array(
                'label' => '链接2'
            ),
            'attributes' => array(
                
                'maxlength' => 100
            )
        ));        
         $this->add(array(
             'name' => 'glsrc3',
             'type' => 'text',
             'options' => array(
                 'label' => '链接3'
             ),
             'attributes' => array(
         
                 'maxlength' => 100
             )
         ));
         $this->add(array(
             'name' => 'gldiscount1',
             'type' => 'text',
             'options' => array(
                 'label' => '折扣1'
             ),
             'attributes' => array(
         
                 'maxlength' => 100
             )
         ));
         $this->add(array(
             'name' => 'gldiscount2',
             'type' => 'text',
             'options' => array(
                 'label' => '折扣2'
             ),
             'attributes' => array(
                  
                 'maxlength' => 100
             )
         ));
         $this->add(array(
             'name' => 'gldiscount3',
             'type' => 'text',
             'options' => array(
                 'label' => '折扣3'
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