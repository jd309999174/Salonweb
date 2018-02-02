<?php
namespace Cosmetic\Appointment;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class AppointmentForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('appointment');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PromotionFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'appointmentid',
            'type' => 'hidden'
        ));
        
       
        $this->add(array(
            'name' => 'cusid',
            'type' => 'text',
            'options' => array(
                'label' => '顾客id'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cusname',
            'type' => 'text',
            'options' => array(
                'label' => '顾客名'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cusphone',
            'type' => 'text',
            'options' => array(
                'label' => '顾客电话'
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
            'name' => 'salbranch',
            'type' => 'text',
            'options' => array(
                'label' => '美容院分院'
            ),
            'attributes' => array(
                'id'=>'salbranch',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'salname',
            'type' => 'text',
            'options' => array(
                'label' => '美容院名'
            ),
            'attributes' => array(
                'id'=>'salname',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'cosid',
            'type' => 'text',
            'options' => array(
                'label' => '美容师编号'
            ),
            'attributes' => array(
                'id'=>'cosid',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'cosname',
            'type' => 'text',
            'options' => array(
                'label' => '美容师名'
            ),
            'attributes' => array(
                'id'=>'cosname',
                'maxlength' => 100
            )
        ));
      
        $this->add(array(
            'name' => 'appointmentdate',
            'type' => 'text',
           
            'attributes' => array(
                'id'=>"datepicker",
                'class'=>'form-control',
                'placeholder'=>"请选择预约日期",
                'maxlength' => 100,
                'readonly'=>'readonly'
            )
        ));
        $this->add(array(
            'name' => 'appointmenttime',
            'type' => 'text',
          
            'attributes' => array(
                'id'=>"timepicki",
                'class'=>'form-control',
                'placeholder'=>"请选择预约时间",
                'maxlength' => 100,
                'readonly'=>'readonly'
            )
        ));
        $this->add(array(
            'name' => 'appointmentstate',
            'type' => 'text',
        
            'attributes' => array(
                'id'=>"appointmentstate",
                'class'=>'form-control',
                'placeholder'=>"预约状态",
                'maxlength' => 100
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => '提交',
                'class' => 'btn btn-primary btn-block btn-lg'
            )
        ));
    }
}