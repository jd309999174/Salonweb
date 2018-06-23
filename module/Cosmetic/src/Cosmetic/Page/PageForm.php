<?php
namespace Cosmetic\Page;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class PageForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('page');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PromotionFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'pageid',
            'type' => 'hidden'
        ));
      
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'modificationtime',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'pagetype',
            'type' => 'text',
            'attributes' => array(
                'id'=>'pagetype',
                'maxlength' => 100,
                'width'=>'100%'
            )
        ));
       
        $this->add(array(
            'name' => 'pagename',
            'type' => 'text',
            
            'attributes' => array(
                'id'=>'pagename',
                'maxlength' => 30
            )
        ));
        $this->add(array(
            'name' => 'pagecolor',
            'type' => 'text',
            
            'attributes' => array(
                'id'=>'pagecolor',
                'maxlength' => 30
            )
        ));
        $this->add(array(
            'name' => 'pagepaddinglr',
            'type' => 'text',
            'attributes' => array(
                'id'=>'pagepaddinglr',
                'maxlength' => 3
            )
        ));
        $this->add(array(
            'name' => 'pagepaddingtop',
            'type' => 'text',
        
            'attributes' => array(
                'id'=>'pagepaddingtop',
                'maxlength' => 3
            )
        ));
        $this->add(array(
            'name' => 'pagepaddingbottom',
            'type' => 'text',
          
            'attributes' => array(
                'id'=>'pagepaddingbottom',
                'maxlength' => 3
            )
        ));
        $this->add(array(
            'name' => 'pagecondition',
            'type' => 'text',
            'options' => array(
                'label' => '页面状态'
            ),
            'attributes' => array(
                'id'=>'pagecondition',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'releasetime',
            'type' => 'text',
            'options' => array(
                'label' => '页面发布时间'
            ),
            'attributes' => array(
                'id'=>'releasetime',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'pageheaddata1',
            'type' => 'text',
           
            'attributes' => array(
                'id'=>'pageheaddata1',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'pageheaddata2',
            'type' => 'text',
           
            'attributes' => array(
                'id'=>'pageheaddata2',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'pageheaddata3',
            'type' => 'text',
            
            'attributes' => array(
                'id'=>'pageheaddata3',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'pageheaddata4',
            'type' => 'text',
           
            'attributes' => array(
                'id'=>'pageheaddata4',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'pageheaddata5',
            'type' => 'text',
           
            'attributes' => array(
                'id'=>'pageheaddata5',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'pageexpiration',
            'type' => 'text',
            
            'attributes' => array(
                'maxlength' => 100,
                'id'=>"datepicker",
                'readonly'=>'readonly'
            )
        ));
        $this->add(array(
            'name' => 'submitname',
            'attributes' => array(
                'type' => 'submit',
                'value' => '提交',
                'class' => 'btn btn-primary',
                'id'=>'submitid'
            )
        ));
    }
}