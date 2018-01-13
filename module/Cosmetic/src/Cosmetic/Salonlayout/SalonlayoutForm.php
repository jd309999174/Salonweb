<?php
namespace Cosmetic\Salonlayout;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class SalonlayoutForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('salonlayout');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PromotionFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'slid',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'slphoto1',
            'type' => 'text',
            'options' => array(
                'label' => '图1'
            ),
            'attributes' => array(
                'id'=>'slphoto1',
                'maxlength' => 100
            )
        ));
        
       $this->add(array(
            'name' => 'slphoto1f',
            'type' => 'file',
            'options' => array(
                'label' => '图1f'
            ),
            'attributes' => array(
                'id'=>'slphoto1f',
                'onchange'=>'change("slphoto1f","slphoto1")',
                'maxlength' => 100
            )
        ));
       $this->add(array(
           'name' => 'slphoto2',
           'type' => 'text',
           'options' => array(
               'label' => '图2'
           ),
           'attributes' => array(
               'id'=>'slphoto2',
               'maxlength' => 100
           )
       ));
       
       $this->add(array(
           'name' => 'slphoto2f',
           'type' => 'file',
           'options' => array(
               'label' => '图2f'
           ),
           'attributes' => array(
               'id'=>'slphoto2f',
               'onchange'=>'change("slphoto2f","slphoto2")',
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slphoto3',
           'type' => 'text',
           'options' => array(
               'label' => '图3'
           ),
           'attributes' => array(
               'id'=>'slphoto3',
               'maxlength' => 100
           )
       ));
       
       $this->add(array(
           'name' => 'slphoto3f',
           'type' => 'file',
           'options' => array(
               'label' => '图3f'
           ),
           'attributes' => array(
               'id'=>'slphoto3f',
               'onchange'=>'change("slphoto3f","slphoto3")',
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slphoto4',
           'type' => 'text',
           'options' => array(
               'label' => '图4'
           ),
           'attributes' => array(
               'id'=>'slphoto4',
               'maxlength' => 100
           )
       ));
       
       $this->add(array(
           'name' => 'slphoto4f',
           'type' => 'file',
           'options' => array(
               'label' => '图4f'
           ),
           'attributes' => array(
               'id'=>'slphoto4f',
               'onchange'=>'change("slphoto4f","slphoto4")',
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slphoto5',
           'type' => 'text',
           'options' => array(
               'label' => '图5'
           ),
           'attributes' => array(
               'id'=>'slphoto5',
               'maxlength' => 100
           )
       ));
       
       $this->add(array(
           'name' => 'slphoto5f',
           'type' => 'file',
           'options' => array(
               'label' => '图5f'
           ),
           'attributes' => array(
               'id'=>'slphoto5f',
               'onchange'=>'change("slphoto5f","slphoto5")',
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slphoto6',
           'type' => 'text',
           'options' => array(
               'label' => '图6'
           ),
           'attributes' => array(
               'id'=>'slphoto6',
               'maxlength' => 100
           )
       ));
       
       $this->add(array(
           'name' => 'slphoto6f',
           'type' => 'file',
           'options' => array(
               'label' => '图6f'
           ),
           'attributes' => array(
               'id'=>'slphoto6f',
               'onchange'=>'change("slphoto6f","slphoto6")',
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slphoto7',
           'type' => 'text',
           'options' => array(
               'label' => '图7'
           ),
           'attributes' => array(
               'id'=>'slphoto7',
               'maxlength' => 100
           )
       ));
       
       $this->add(array(
           'name' => 'slphoto7f',
           'type' => 'file',
           'options' => array(
               'label' => '图7f'
           ),
           'attributes' => array(
               'id'=>'slphoto7f',
               'onchange'=>'change("slphoto7f","slphoto7")',
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slphoto8',
           'type' => 'text',
           'options' => array(
               'label' => '图8'
           ),
           'attributes' => array(
               'id'=>'slphoto8',
               'maxlength' => 100
           )
       ));
       
       $this->add(array(
           'name' => 'slphoto8f',
           'type' => 'file',
           'options' => array(
               'label' => '图8f'
           ),
           'attributes' => array(
               'id'=>'slphoto8f',
               'onchange'=>'change("slphoto8f","slphoto8")',
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slphoto9',
           'type' => 'text',
           'options' => array(
               'label' => '图9'
           ),
           'attributes' => array(
               'id'=>'slphoto9',
               'maxlength' => 100
           )
       ));
       
       $this->add(array(
           'name' => 'slphoto9f',
           'type' => 'file',
           'options' => array(
               'label' => '图9f'
           ),
           'attributes' => array(
               'id'=>'slphoto9f',
               'onchange'=>'change("slphoto9f","slphoto9")',
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slphoto10',
           'type' => 'text',
           'options' => array(
               'label' => '图10'
           ),
           'attributes' => array(
               'id'=>'slphoto10',
               'maxlength' => 100
           )
       ));
       
       $this->add(array(
           'name' => 'slphoto10f',
           'type' => 'file',
           'options' => array(
               'label' => '图10f'
           ),
           'attributes' => array(
               'id'=>'slphoto10f',
               'onchange'=>'change("slphoto10f","slphoto10")',
               'maxlength' => 100
           )
       ));
       
       $this->add(array(
           'name' => 'slsrc1',
           'type' => 'text',
           'options' => array(
               'label' => '链接1'
           ),
           'attributes' => array(
               
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slsrc2',
           'type' => 'text',
           'options' => array(
               'label' => '链接2'
           ),
           'attributes' => array(
                
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slsrc3',
           'type' => 'text',
           'options' => array(
               'label' => '链接3'
           ),
           'attributes' => array(
                
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slsrc4',
           'type' => 'text',
           'options' => array(
               'label' => '链接4'
           ),
           'attributes' => array(
                
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slsrc5',
           'type' => 'text',
           'options' => array(
               'label' => '链接5'
           ),
           'attributes' => array(
                
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slsrc6',
           'type' => 'text',
           'options' => array(
               'label' => '链接6'
           ),
           'attributes' => array(
                
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slsrc7',
           'type' => 'text',
           'options' => array(
               'label' => '链接7'
           ),
           'attributes' => array(
                
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slsrc8',
           'type' => 'text',
           'options' => array(
               'label' => '链接8'
           ),
           'attributes' => array(
                
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slsrc9',
           'type' => 'text',
           'options' => array(
               'label' => '链接9'
           ),
           'attributes' => array(
                
               'maxlength' => 100
           )
       ));
       $this->add(array(
           'name' => 'slsrc10',
           'type' => 'text',
           'options' => array(
               'label' => '链接10'
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