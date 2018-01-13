<?php
namespace Cosmetic\Picture;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class PictureForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('prize');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PrizeFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'picid',
            'type' => 'hidden'
        ));
     
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'picturename',
            'type' => 'text',
            'options' => array(
                'label' => '图片名'
            ),
            'attributes' => array(
                'maxlength' => 100,
                'id'=>'picturename'
            )
        ));
        $this->add(array(
            'name' => 'picturefile',
            'type' => 'file',
            'options' => array(
                'label' => '图片文件'
            ),
            'attributes' => array(
                'id'=>'picturefile',
                'multiple'=>'ture',
                'maxlength' => 100,
                'onchange'=>'change("picturefile","picturename")',
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