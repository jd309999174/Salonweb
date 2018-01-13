<?php
namespace Cosmetic\Salonslide;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class SalonslideForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('salonslide');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PromotionFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'ssid',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'ssphoto1',
            'type' => 'text',
            'options' => array(
                'label' => '幻灯片1'
            ),
            'attributes' => array(
                'id'=>'ssphoto1',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'ssphoto2',
            'type' => 'text',
            'options' => array(
                'label' => '幻灯片2'
            ),
            'attributes' => array(
                'id'=>'ssphoto2',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'ssphoto3',
            'type' => 'text',
            'options' => array(
                'label' => '幻灯片3'
            ),
            'attributes' => array(
                'id'=>'ssphoto3',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'ssphoto1f',
            'type' => 'file',
            'options' => array(
                'label' => '幻灯片1f'
            ),
            'attributes' => array(
                'id'=>'ssphoto1f',
                'onchange'=>'change("ssphoto1f","ssphoto1")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'ssphoto2f',
            'type' => 'file',
            'options' => array(
                'label' => '幻灯片2f'
            ),
            'attributes' => array(
                'id'=>'ssphoto2f',
                'onchange'=>'change("ssphoto2f","ssphoto2")',
                'maxlength' => 100
            )
        ));$this->add(array(
            'name' => 'ssphoto3f',
            'type' => 'file',
            'options' => array(
                'label' => '幻灯片3f'
            ),
            'attributes' => array(
                'id'=>'ssphoto3f',
                'onchange'=>'change("ssphoto3f","ssphoto3")',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'sssrc1',
            'type' => 'text',
            'options' => array(
                'label' => '链接1'
            ),
            'attributes' => array(
                'maxlength' => 500
            )
        ));
        $this->add(array(
            'name' => 'sssrc2',
            'type' => 'text',
            'options' => array(
                'label' => '链接2'
            ),
            'attributes' => array(
                'maxlength' => 500
            )
        ));
        $this->add(array(
            'name' => 'sssrc3',
            'type' => 'text',
            'options' => array(
                'label' => '链接3'
            ),
            'attributes' => array(
                'maxlength' => 500
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