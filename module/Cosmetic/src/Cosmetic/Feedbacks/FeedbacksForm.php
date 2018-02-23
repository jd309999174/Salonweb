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
                'id'=>'treid'
            )
        ));
        
        $this->add(array(
            'name' => 'salbranch',
            'type' => 'text',
            'options' => array(
                'label' => 'salbranch'
            ),
            'attributes' => array(
                'id'=>'salbranch'
            )
        ));
        $this->add(array(
            'name' => 'cosid',
            'type' => 'text',
            'options' => array(
                'label' => 'cosid'
            ),
            'attributes' => array(
                'id'=>'cosid'
            )
        ));
        
        $this->add(array(
            'name' => 'fbsurrounding',
            'type' => 'text',
            'options' => array(
                'label' => 'fbsurrounding'
            ),
            'attributes' => array(
                'id'=>'fbsurrounding'
            )
        ));
        
        $this->add(array(
            'name' => 'fbproduct',
            'type' => 'text',
            'options' => array(
                'label' => 'fbproduct'
            ),
            'attributes' => array(
                'id'=>'fbproduct'
            )
        ));
        
        $this->add(array(
            'name' => 'fbcosmetologist',
            'type' => 'text',
            'options' => array(
                'label' => 'fbcosmetologist'
            ),
            'attributes' => array(
                'id'=>'fbcosmetologist'
            )
        ));
        
        $this->add(array(
            'name' => 'fbadvise',
            'type' => 'Zend\Form\Element\Textarea',
           
            'attributes' => array(
                'id'=>'fbadvise',
                'class'=>"form-control",
                'placeholder'=>"评价与建议"
            )
        ));
        $this->add(array(
            'name' => 'fbadvise1',
            'type' => 'Zend\Form\Element\Textarea',
             
            'attributes' => array(
                'id'=>'fbadvise1',
                'class'=>"form-control",
                'placeholder'=>"评价与建议"
            )
        ));
        $this->add(array(
            'name' => 'fbadvise2',
            'type' => 'Zend\Form\Element\Textarea',
             
            'attributes' => array(
                'id'=>'fbadvise2',
                'class'=>"form-control",
                'placeholder'=>"评价与建议"
            )
        ));
        
        //环境评价图
        $this->add(array(
            'name' => 'fbpicture1',
            'type' => 'text',
            
            'attributes' => array(
                'id'=>'fbpicture1',
                'class'=>'form-control'
            )
        ));
        $this->add(array(
            'name' => 'fbpicture1f',
            'type' => 'file',
            
            'attributes' => array(
                'multiple'=>'ture',//重点，直接用html的input multiple似乎不行
                'class'=>'form-control',
                'id'=>'fbpicture1f',
                //'onchange'=>'change("fbpicture1f","fbpicture1")',
                'data-show-upload'=>'false',
                'data-show-caption'=>'true',
                'data-msg-placeholder'=>'选择 {files}'
            )
        ));
        
        //产品评价图
        $this->add(array(
            'name' => 'fbpicture2',
            'type' => 'text',
            
            'attributes' => array(
                'id'=>'fbpicture2',
                'class'=>'form-control'
            )
        ));
        $this->add(array(
            'name' => 'fbpicture2f',
            'type' => 'file',
            
            'attributes' => array(
                'multiple'=>'ture',//重点，直接用html的input multiple似乎不行
                'class'=>'form-control',
                'id'=>'fbpicture2f',
                //'onchange'=>'change("fbpicture2f","fbpicture2")',
                'data-show-upload'=>'false',
                'data-show-caption'=>'true',
                'data-msg-placeholder'=>'选择 {files}'
            )
        ));
        
        //服务评价图
        $this->add(array(
            'name' => 'fbpicture3',
            'type' => 'text',
            
            'attributes' => array(
                'id'=>'fbpicture3',
                'class'=>'form-control'
            )
        ));
        $this->add(array(
            'name' => 'fbpicture3f',
            'type' => 'file',
            
            'attributes' => array(
                'multiple'=>'ture',//重点，直接用html的input multiple似乎不行
                'class'=>'form-control',
                'id'=>'fbpicture3f',
                //'onchange'=>'change("fbpicture3f","fbpicture3")',
                'data-show-upload'=>'false',
                'data-show-caption'=>'true',
                'data-msg-placeholder'=>'选择 {files}'
            )
        ));
      
        //店家回复1
        $this->add(array(
            'name' => 'salcomment1',
            'type' => 'text',
            
            'attributes' => array(
                'id'=>'salcomment1',
                'class'=>'form-control'
            )
        ));
        
        //店家回复2
        $this->add(array(
            'name' => 'salcomment2',
            'type' => 'text',
            
            'attributes' => array(
                'id'=>'salcomment2',
                'class'=>'form-control'
            )
        ));
        //店家回复3
        $this->add(array(
            'name' => 'salcomment3',
            'type' => 'text',
            
            'attributes' => array(
                'id'=>'salcomment3',
                'class'=>'form-control'
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