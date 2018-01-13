<?php
namespace Cosmetic\Promotion;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class PromotionForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('promotion');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PromotionFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'promid',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'salnumber',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'cosnumber',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'cusnumber',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'promsort',
            'type' => 'text',
            'options' => array(
                'label' => '分类'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promauthor',
            'type' => 'text',
            'options' => array(
                'label' => '作者'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promthumbnail',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'promtitle',
            'type' => 'text',
            'options' => array(
                'label' => '标题'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'promdetail',
            'type' => 'text',
            'options' => array(
                'label' => '文字描述'
            ),
            'attributes' => array(
                'maxlength' => 500
            )
        ));
        
        $this->add(array(
            'name' => 'promphoto1',
            'type' => 'text',
            'options' => array(
                'label' => '图片1'
            ),
            'attributes' => array(
                'id'=>'promphoto1',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'promphoto2',
            'type' => 'text',
            'options' => array(
                'label' => '图片2'
            ),
            'attributes' => array(
                'id'=>'promphoto2',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto3',
            'type' => 'text',
            'options' => array(
                'label' => '图片3'
            ),
            'attributes' => array(
                'id'=>'promphoto3',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto4',
            'type' => 'text',
            'options' => array(
                'label' => '图片4'
            ),
            'attributes' => array(
                'id'=>'promphoto4',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto5',
            'type' => 'text',
            'options' => array(
                'label' => '图片5'
            ),
            'attributes' => array(
                'id'=>'promphoto5',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto6',
            'type' => 'text',
            'options' => array(
                'label' => '图片6'
            ),
            'attributes' => array(
                'id'=>'promphoto6',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto7',
            'type' => 'text',
            'options' => array(
                'label' => '图片7'
            ),
            'attributes' => array(
                'id'=>'promphoto7',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto8',
            'type' => 'text',
            'options' => array(
                'label' => '图片8'
            ),
            'attributes' => array(
                'id'=>'promphoto8',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto9',
            'type' => 'text',
            'options' => array(
                'label' => '图片9'
            ),
            'attributes' => array(
                'id'=>'promphoto9',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto10',
            'type' => 'text',
            'options' => array(
                'label' => '图片10'
            ),
            'attributes' => array(
                'id'=>'promphoto10',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto1f',
            'type' => 'file',
            'options' => array(
                'label' => '图片1f'
            ),
            'attributes' => array(
                'id'=>'promphoto1f',
                'onchange'=>'change("promphoto1f","promphoto1")',
                'maxlength' => 100
            )
        ));
        
        $this->add(array(
            'name' => 'promphoto2f',
            'type' => 'file',
            'options' => array(
                'label' => '图片2f'
            ),
            'attributes' => array(
                'id'=>'promphoto2f',
                'onchange'=>'change("promphoto2f","promphoto2")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto3f',
            'type' => 'file',
            'options' => array(
                'label' => '图片3f'
            ),
            'attributes' => array(
                'id'=>'promphoto3f',
                'onchange'=>'change("promphoto3f","promphoto3")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto4f',
            'type' => 'file',
            'options' => array(
                'label' => '图片4f'
            ),
            'attributes' => array(
                'id'=>'promphoto4f',
                'onchange'=>'change("promphoto4f","promphoto4")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto5f',
            'type' => 'file',
            'options' => array(
                'label' => '图片5f'
            ),
            'attributes' => array(
                'id'=>'promphoto5f',
                'onchange'=>'change("promphoto5f","promphoto5")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto6f',
            'type' => 'file',
            'options' => array(
                'label' => '图片6f'
            ),
            'attributes' => array(
                'id'=>'promphoto6f',
                'onchange'=>'change("promphoto6f","promphoto6")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto7f',
            'type' => 'file',
            'options' => array(
                'label' => '图片7f'
            ),
            'attributes' => array(
                'id'=>'promphoto7f',
                'onchange'=>'change("promphoto7f","promphoto7")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto8f',
            'type' => 'file',
            'options' => array(
                'label' => '图片8f'
            ),
            'attributes' => array(
                'id'=>'promphoto8f',
                'onchange'=>'change("promphoto8f","promphoto8")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto9f',
            'type' => 'file',
            'options' => array(
                'label' => '图片9f'
            ),
            'attributes' => array(
                'id'=>'promphoto9f',
                'onchange'=>'change("promphoto9f","promphoto9")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promphoto10f',
            'type' => 'file',
            'options' => array(
                'label' => '图片10f'
            ),
            'attributes' => array(
                'id'=>'promphoto10f',
                'onchange'=>'change("promphoto10f","promphoto10")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promsrc1',
            'type' => 'text',
            'options' => array(
                'label' => '链接1'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promsrc2',
            'type' => 'text',
            'options' => array(
                'label' => '链接2'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promsrc3',
            'type' => 'text',
            'options' => array(
                'label' => '链接3'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promsrc4',
            'type' => 'text',
            'options' => array(
                'label' => '链接4'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promsrc5',
            'type' => 'text',
            'options' => array(
                'label' => '链接5'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promsrc6',
            'type' => 'text',
            'options' => array(
                'label' => '链接6'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promsrc7',
            'type' => 'text',
            'options' => array(
                'label' => '链接7'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promsrc8',
            'type' => 'text',
            'options' => array(
                'label' => '链接8'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promsrc9',
            'type' => 'text',
            'options' => array(
                'label' => '链接9'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promsrc10',
            'type' => 'text',
            'options' => array(
                'label' => '链接10'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
       
        
        $this->add(array(
            'name' => 'promvideo',
            'type' => 'text',
            'options' => array(
                'label' => '视频'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promvideof',
            'type' => 'file',
            'options' => array(
                'label' => '视频f'
            ),
            'attributes' => array(
                'id'=>'promvideof',
                'onchange'=>'change("promvideof","promvideo")',
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promdescription1',
            'type' => 'text',
            'options' => array(
                'label' => '描述1'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promdescription2',
            'type' => 'text',
            'options' => array(
                'label' => '描述2'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promdescription3',
            'type' => 'text',
            'options' => array(
                'label' => '描述3'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promdescription4',
            'type' => 'text',
            'options' => array(
                'label' => '描述4'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promdescription5',
            'type' => 'text',
            'options' => array(
                'label' => '描述5'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promdescription6',
            'type' => 'text',
            'options' => array(
                'label' => '描述6'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promdescription7',
            'type' => 'text',
            'options' => array(
                'label' => '描述7'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promdescription8',
            'type' => 'text',
            'options' => array(
                'label' => '描述8'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promdescription9',
            'type' => 'text',
            'options' => array(
                'label' => '描述9'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promdescription10',
            'type' => 'text',
            'options' => array(
                'label' => '描述10'
            ),
            'attributes' => array(
        
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'promoverdue',
            'type' => 'checkbox',
            'options' => array(
                'label' => '过期？',
                'label_attributes' => array(
                    'class' => 'checkbox'
                )
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