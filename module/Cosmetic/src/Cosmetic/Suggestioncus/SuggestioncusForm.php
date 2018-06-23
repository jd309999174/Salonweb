<?php
namespace Cosmetic\Suggestioncus;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;


class SuggestioncusForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('suggestioncus');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new TaskFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'salname',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'salbossname',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'salbossphone',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'salbossphoto',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'cusid',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cusname',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cusphone',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cusphoto',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cuscomment',
            'type' => 'textarea',
            'height'=>'200px',
            'attributes' => array(
                'class'=> 'form-control',
                'placeholder'=>"欢迎提出您在使用中遇到问题或宝贵意见，感谢您的支持",
                'maxlength' => 250
            )
        ));
        $this->add(array(
            'name' => 'cuspicture',
            'type' => 'text',
            'attributes' => array(
                'maxlength' => 100,
                'id'=>'cuspicture'
            )
        ));
        $this->add(array(
            'name' => 'cuspicturef',
            'type' => 'file',
            'attributes' => array(
                'maxlength' => 100,
                'onchange'=>'change("cuspicturef","cuspicture")',
                'id'=>'cuspicturef'
            )
        ));
        

        $this->add(array(
            'name' => 'submitname',
            'attributes' => array(
                'id'=>'signupsubmit',
                'type' => 'submit',
                'class' => 'btn btn-primary form-control'
            )
        ));
    }
}