<?php
namespace Cosmetic\Subbranch;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class SubranchForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('subbranch');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PromotionFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'sub_id',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'sal_number',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'sub_branch1',
            'type' => 'text',
            'options' => array(
                'label' => '分店1'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'sub_branch2',
            'type' => 'text',
            'options' => array(
                'label' => '分店2'
            ),
            'attributes' => array(
                'maxlength' => 500
            )
        ));
        
        $this->add(array(
            'name' => 'sub_branch3',
            'type' => 'text',
            'options' => array(
                'label' => '分店3'
            ),
            'attributes' => array(
              
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'sub_branch4',
            'type' => 'text',
            'options' => array(
                'label' => '分店4'
            ),
            'attributes' => array(
                
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'sub_branch5',
            'type' => 'text',
            'options' => array(
                'label' => '分店5'
            ),
            'attributes' => array(
               
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'sub_branch6',
            'type' => 'text',
            'options' => array(
                'label' => '分店6'
            ),
            'attributes' => array(
                
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'sub_branch7',
            'type' => 'text',
            'options' => array(
                'label' => '分店7'
            ),
            'attributes' => array(
                
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'sub_branch8',
            'type' => 'text',
            'options' => array(
                'label' => '分店8'
            ),
            'attributes' => array(
                
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'sub_branch9',
            'type' => 'text',
            'options' => array(
                'label' => '分店9'
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