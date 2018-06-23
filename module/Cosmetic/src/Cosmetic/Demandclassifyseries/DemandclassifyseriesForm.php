<?php 
namespace Cosmetic\Demandclassifyseries;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class DemandclassifyseriesForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct('demandclassifyseries');
    
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new SalonFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'dcsid',
            'type' => 'hidden',
            'attributes' => array(
                'value' => null
            )
        ));
        
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'text',
            'options' => array(
                'label' => '编号'
            ),
            'attributes' => array(
                'class'=>"form-control",
                
                
            )
        ));
        $this->add(array(
            'name' => 'dcscolumn',
            'type' => 'Zend\Form\Element\Radio',
            'options' => array(
                'label' => '分类',
                'value_options' => array(
                    '需求' => '需求',
                    '类别' => '类别',
                    '系列' => '系列',
                ),
            ),
           
        ));
      
        $this->add(array(
            'name' => 'dcsname',
            'type' => 'text',
            'options' => array(
                'label' => '分类名'
            ),
            'attributes' => array(
                'class'=>"form-control",
                
            )
        ));
        $this->add(array(
            'name' => 'dcsbackground',
            'type' => 'text',
            'options' => array(
                'label' => '背景图'
            ),
            'attributes' => array(
                'id'=>'dcsbackground',
                
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Go',
                'class' => 'btn btn-default',
                'id'=>'submit'
            )
        ));
        
   }
}
?>