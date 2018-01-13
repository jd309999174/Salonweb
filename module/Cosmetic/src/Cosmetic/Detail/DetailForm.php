<?php
namespace Cosmetic\Detail;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class DetailForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('detail');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new DetailFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'detid',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'prodnumber',
            'type' => 'hidden'
        ));
        

        $this->add(array(
            'name' => 'detpicture1',
            'type' => 'text',
            'options' => array(
                'label' => '图1'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture2',
            'type' => 'text',
            'options' => array(
                'label' => '图2'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture3',
            'type' => 'text',
            'options' => array(
                'label' => '图3'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture4',
            'type' => 'text',
            'options' => array(
                'label' => '图4'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture5',
            'type' => 'text',
            'options' => array(
                'label' => '图5'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'detpicture6',
            'type' => 'text',
            'options' => array(
                'label' => '图6'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture7',
            'type' => 'text',
            'options' => array(
                'label' => '图7'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture8',
            'type' => 'text',
            'options' => array(
                'label' => '图8'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture9',
            'type' => 'text',
            'options' => array(
                'label' => '图9'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture10',
            'type' => 'text',
            'options' => array(
                'label' => '图10'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture11',
            'type' => 'text',
            'options' => array(
                'label' => '图11'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture1',
            'type' => 'text',
            'options' => array(
                'label' => '图1'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture1f',
            'type' => 'file',
            'options' => array(
                'label' => '图1f'
            ),
            'attributes' => array(
                'id'=>'detpicture1f',
                'onchange'=>'change("detpicture1f","detpicture1")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture2f',
            'type' => 'file',
            'options' => array(
                'label' => '图2f'
            ),
            'attributes' => array(
                'id'=>'detpicture2f',
                'onchange'=>'change("detpicture2f","detpicture2")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture3f',
            'type' => 'file',
            'options' => array(
                'label' => '图3f'
            ),
            'attributes' => array(
                'id'=>'detpicture3f',
                'onchange'=>'change("detpicture3f","detpicture3")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture4f',
            'type' => 'file',
            'options' => array(
                'label' => '图4f'
            ),
            'attributes' => array(
                'id'=>'detpicture4f',
                'onchange'=>'change("detpicture4f","detpicture4")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture5f',
            'type' => 'file',
            'options' => array(
                'label' => '图5f'
            ),
            'attributes' => array(
                'id'=>'detpicture5f',
                'onchange'=>'change("detpicture5f","detpicture5")',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'detpicture6f',
            'type' => 'file',
            'options' => array(
                'label' => '图6f'
            ),
            'attributes' => array(
                'id'=>'detpicture6f',
                'onchange'=>'change("detpicture6f","detpicture6")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture7f',
            'type' => 'file',
            'options' => array(
                'label' => '图7f'
            ),
            'attributes' => array(
                'id'=>'detpicture7f',
                'onchange'=>'change("detpicture7f","detpicture7")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture8f',
            'type' => 'file',
            'options' => array(
                'label' => '图8f'
            ),
            'attributes' => array(
                'id'=>'detpicture8f',
                'onchange'=>'change("detpicture8f","detpicture8")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture9',
            'type' => 'file',
            'options' => array(
                'label' => '图9'
            ),
            'attributes' => array(
                'id'=>'detpicture9f',
                'onchange'=>'change("detpicture9f","detpicture9")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture10f',
            'type' => 'file',
            'options' => array(
                'label' => '图10f'
            ),
            'attributes' => array(
                'id'=>'detpicture10f',
                'onchange'=>'change("detpicture10f","detpicture10")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detpicture11f',
            'type' => 'file',
            'options' => array(
                'label' => '图11f'
            ),
            'attributes' => array(
                'id'=>'detpicture11f',
                'onchange'=>'change("detpicture11f","detpicture11")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detvideo',
            'type' => 'text',
            'options' => array(
                'label' => '视频'
            ),
            'attributes' => array(
                'id'=>'detvideo',
         
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'detvideof',
            'type' => 'file',
            'options' => array(
                'label' => '视频f'
            ),
            'attributes' => array(
                'id'=>'detvideof',
                'onchange'=>'change("detvideof","detvideo")',
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