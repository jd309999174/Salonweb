<?php
namespace Cosmetic\Trolley;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class TrolleyForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('trolley');
        
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new PromotionFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'trolleyid',
            'type' => 'hidden'
        ));
    $this->add(array(
            'name' => 'cusid',
            'type' => 'text',
            'options' => array(
                'label' => '用户id'
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
            'name' => 'prodid',
            'type' => 'text',
            'options' => array(
                'label' => '产品id'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
      $this->add(array(
            'name' => 'prodtitle',
            'type' => 'text',
            'options' => array(
                'label' => '产品标题'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'productcombinationid',
            'type' => 'text',
            'options' => array(
                'label' => '组合分类id'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'productcombinationprice',
            'type' => 'text',
            'options' => array(
                'label' => '组合分类价格'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'productcombinationpicture',
            'type' => 'text',
            'options' => array(
                'label' => '组合分类图片'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'productcombinationname',
            'type' => 'text',
            'options' => array(
                'label' => '组合分类名'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'productquantity',
            'type' => 'text',
            'options' => array(
                'label' => '选择数量'
            ),
            'attributes' => array(
                'maxlength' => 100
            )
        ));
        $this->add(array(
            'name' => 'trolleydate',
            'type' => 'text',
            'options' => array(
                'label' => '日期'
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