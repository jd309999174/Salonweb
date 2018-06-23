<?php 
namespace Cosmetic\Salon;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class SalonForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct('salon');
    
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new SalonFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'salid',
            'type' => 'hidden',
            'attributes' => array(
                'value' => null
            )
        ));
        
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'text',
            
            'attributes' => array(
                'class'=>"form-control",
                
                
            )
        ));
        $this->add(array(
            'name' => 'salbranch',
            'type' => 'text',
            
            'attributes' => array(
                'placeholder'=>"请输入分店号",
                'class'=>"form-control",
                
                //'onchange'=>'tanchuang("salbranch")',
                
            )
        ));
       
        $this->add(array(
            'name' => 'salname',
            'type' => 'text',
           
            'attributes' => array(
                'placeholder'=>"请输入店名",
                'class'=>"form-control",
                
            )
        ));
        $this->add(array(
            'name' => 'salphone',
            'type' => 'text',
           
            'attributes' => array(
                'placeholder'=>"请输入电话",
                'class'=>"form-control",

            )
        ));
        $this->add(array(
            'name' => 'saladdress',
            'type' => 'text',
           
            'attributes' => array(
                'placeholder'=>"请输入地址",
                'class'=>"form-control",
                
            )
        ));
      
        $this->add(array(
            'name' => 'salphoto1',
            'type' => 'text',
            'options' => array(
                'label' => '美院美图1'
              
            ),
            'attributes' => array(
                'class'=>"form-control",
                'id'=>"salphoto1",
                
            )
        ));
        $this->add(array(
            'name' => 'salphoto2',
            'type' => 'text',
            'options' => array(
                'label' => '美院美图2'
              
            ),
            'attributes' => array(
                'class'=>"form-control",
                'id'=>"salphoto2",
                
            )
        ));
        $this->add(array(
            'name' => 'salphoto3',
            'type' => 'text',
            'options' => array(
                'label' => '美院美图3'
                
            ),
            'attributes' => array(
                'class'=>"form-control",
                'id'=>"salphoto3",
                
            )
        ));
       
        $this->add(array(
            'name' => 'salregnumber',
            'type' => 'text',
            'options' => array(
                'label' => '工商号'
            ),
            'attributes' => array(
                'placeholder'=>"请输入工商号",
                'class'=>"form-control",
                
            )
        ));
        $this->add(array(
            'name' => 'submitname',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Go',
                'class' => 'btn btn-default'
            )
        ));
        
 //美容院：id,美容院编号，账号，密码，店名，电话，地址，老板名，老板电话，老板身份证号，店面图片（1-3），工商登记号，注册日期
    }
}
?>