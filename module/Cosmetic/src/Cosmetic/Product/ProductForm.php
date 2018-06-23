<?php 
namespace Cosmetic\Product;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class ProductForm extends Form
{
    //9.产品管理（product） id，美容院，标题，参数，价格，折扣，图5个，描述，服务流程，需求，分类，系列；
    //参数部分：品牌，规格，含量，指数，产地，批准文号，功效，有效期,疗程次数
    public function __construct($name = null, $options = array())
    {
        parent::__construct('product');
    
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new SalonFilter());
        $this->setHydrator(new ClassMethods());
        
        $this->add(array(
            'name' => 'prodid',
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
            'name' => 'prodtitle',
            'type' => 'text',
            'options' => array(
                
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"请输入标题",
                
                'required'=>'required'
            )
        ));
        $this->add(array(
            'name' => 'prodprice',
            'type' => 'text',
            'options' => array(
               
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"请输入价格",
                
                'required'=>'required'
            )
        ));
        $this->add(array(
            'name' => 'prodoriginal',
            'type' => 'text',
            'options' => array(
                 
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"请输入原价",
                
                'required'=>'required'
            )
        ));
        
        $this->add(array(
            'name' => 'prodpicture1',
            'type' => 'text',
            'options' => array(
                'label' => '图片1'
            ),
            'attributes' => array(
                'class'=>'form-control',
                'id'=>"prodpicture1",
                
            )
        ));
        $this->add(array(
            'name' => 'prodpicture2',
            'type' => 'text',
            'options' => array(
                'label' => '图片2'
            ),
            'attributes' => array(
                'class'=>'form-control',
                'id'=>"prodpicture2",
                
            )
        ));
        $this->add(array(
            'name' => 'prodpicture3',
            'type' => 'text',
            'options' => array(
                'label' => '图片3'
            ),
            'attributes' => array(
                'class'=>'form-control',
                'id'=>"prodpicture3",
                
            )
        ));
        $this->add(array(
            'name' => 'prodpicture4',
            'type' => 'text',
            'options' => array(
                'label' => '图片4'
            ),
            'attributes' => array(
                'class'=>'form-control',
                'id'=>"prodpicture4",
                
            )
        ));
        $this->add(array(
            'name' => 'prodpicture5',
            'type' => 'text',
            'options' => array(
                'label' => '图片5'
            ),
            'attributes' => array(
                'class'=>'form-control',
                'id'=>"prodpicture5",
                
            )
        ));
        
        $this->add(array(
            'name' => 'proddemandclassifyseries',
            'type' => 'text',
            'options' => array(
                
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"点击图标选择分类",
                
                'id'=>'proddemandclassifyseries'
            )
        ));
        
        
        
        //参数部分
        $this->add(array(
            'name' => 'prodbrand',
            'type' => 'text',
            'options' => array(
                
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"请输入品牌",
                
            )
        ));
        $this->add(array(
            'name' => 'prodspecification',
            'type' => 'text',
            'options' => array(
               
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"请输入规格",
                
            )
        ));
        $this->add(array(
            'name' => 'prodcontent',
            'type' => 'text',
            'options' => array(
                
              
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"请输入含量",
                
            )
        ));
        $this->add(array(
            'name' => 'prodfactor',
            'type' => 'text',
            'options' => array(
                
                
              
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"请输入指数",
                
            )
        ));
        $this->add(array(
            'name' => 'prodplace',
            'type' => 'text',
            'options' => array(
                
                
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"请输入产地",
                
            )
        ));
        $this->add(array(
            'name' => 'prodapproval',
            'type' => 'text',
            'options' => array(
                
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"请输入批号",
                
            )
        ));
        $this->add(array(
            'name' => 'prodefficacy',
            'type' => 'text',
            'options' => array(
                
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"请输入功效",
                
            )
        ));
        $this->add(array(
            'name' => 'prodvalidity',
            'type' => 'text',
            'options' => array(
               
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"请输入有效期",
                
            )
        ));
        $this->add(array(
            'name' => 'prodtreatment',
            'type' => 'text',
            'options' => array(
                
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"请输入疗程次数",
                
            )
        ));
        $this->add(array(
            'name' => 'sharedstate',
            'type' => 'checkbox',
        ));
        $this->add(array(
            'name' => 'prodsales',
            'type' => 'text',
            'options' => array(
        
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"请输入销量",
                
            )
        ));
        $this->add(array(
            'name' => 'prodregdate',
            'type' => 'text',
            'options' => array(
        
            ),
            'attributes' => array(
                'class'=>'form-control',
                'placeholder'=>"上架日期",
                
            )
        ));
        
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => '提交',
                'class' => 'btn btn-default'
            )
        ));
        
    }
}
?>