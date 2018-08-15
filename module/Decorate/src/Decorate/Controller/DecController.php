<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Decorate for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Decorate\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Decorate\Template\TemplateEntity;
use Cosmetic\Page\PageForm;
use Cosmetic\Customer\CustomerMapper;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\View\Model\ViewModel;
use Cosmetic\Salon\SalonForm;
use Cosmetic\Salon\SalonEntity;
use Cosmetic\Promotion\PromotionEntity;
use Cosmetic\Promotion\PromotionForm;
use Cosmetic\Cosmetologist\CosmetologistForm;
use Cosmetic\Cosmetologist\CosmetologistEntity;
use Cosmetic\Salonlayout\SalonlayoutForm;
use Cosmetic\Salonlayout\SalonlayoutEntity;
use Cosmetic\Customer\CustomerForm;
use Cosmetic\Customer\CustomerEntity;
use Cosmetic\Product\ProductEntity;
use Cosmetic\Product\ProductForm;
use Cosmetic\Treatment\TreatmentForm;
use Cosmetic\Treatment\TreatmentEntity;
use Cosmetic\Appointment\AppointmentForm;
use Cosmetic\Appointment\AppointmentEntity;
use Cosmetic\Generallayout\GenerallayoutForm;
use Cosmetic\Generallayout\GenerallayoutEntity;
use Cosmetic\Prize\PrizeForm;
use Cosmetic\Prize\PrizeEntity;
use Cosmetic\Salonslide\SalonslideEntity;
use Cosmetic\Salonslide\SalonslideForm;
use Cosmetic\Salonbutton\SalonbuttonEntity;
use Cosmetic\Salonbutton\SalonbuttonForm;
use Cosmetic\Saloncouponissue\SaloncouponissueEntity;
use Cosmetic\Saloncouponissue\SaloncouponissueForm;
use Cosmetic\Picture\PictureForm;
use Cosmetic\Page\PageEntity;
use Cosmetic\Demandclassifyseries\DemandclassifyseriesEntity;
use Cosmetic\Demandclassifyseries\DemandclassifyseriesForm;
use Cosmetic\Account\AccountEntity;
use Cosmetic\Account\AccountForm;
use Cosmetic\Productcombination\ProductcombinationForm;
use Cosmetic\Productcombination\ProductcombinationEntity;
use Cosmetic\Custombutton\CustombuttonForm;
use Cosmetic\Custombutton\CustombuttonEntity;
use Cosmetic\Notificationinfo\NotificationinfoEntity;
use Cosmetic\Notificationinfo\NotificationinfoForm;
use Cosmetic\Cusleveltype\CusleveltypeEntity;
use Cosmetic\Cusleveltype\CusleveltypeForm;
use Cosmetic\Cusbrowsinghistory\CusbrowsinghistoryEntity;
use Cosmetic\Feedbacks\FeedbacksForm;
date_default_timezone_set('Asia/Shanghai');//时区
class DecController extends AbstractActionController
{
    public function getCustomerMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('CustomerMapper');
    }
    public function getTemplateMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('TemplateMapper');
    }
    public function getPageMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('PageMapper');
    }
    public function getProductMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('ProductMapper');
    }
    public function getDemandclassifyseriesMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('DemandclassifyseriesMapper');
    }
    public function getTipMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('TipMapper');
    }

    public function getCusbrowsinghistoryMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('CusbrowsinghistoryMapper');
    }
    public function getFeedbacksMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('FeedbacksMapper');
    }
    public function getNotificationinfoMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('NotificationinfoMapper');
    }
    public function getProductcombinationMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('ProductcombinationMapper');
    }
    public function getAccountMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('AccountMapper');
    }
    public function getCustombuttonMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('CustombuttonMapper');
    }
    public function getPictureMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('PictureMapper');
    }

    
    public function getSaloncouponissueMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('SaloncouponissueMapper');
    }
    
    public function getSaloncoupongetMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('SaloncoupongetMapper');
    }
    
    public function getSalonMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('SalonMapper');
    }
    
    public function getSalonbuttonMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('SalonbuttonMapper');
    }
    
    public function getSalonslideMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('SalonslideMapper');
    }
    
    public function getGenerallayoutMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('GenerallayoutMapper');
    }
    
    public function getAppointmentMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('AppointmentMapper');
    }
    
    public function getSalonlayoutMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('SalonlayoutMapper');
    }
    
    public function getPromotionMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('PromotionMapper');
    }
    
    public function getCosmetologistMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('CosmetologistMapper');
    }
    

    public function getCusleveltypeMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('CusleveltypeMapper');
    }
    public function getDetailMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('DetailMapper');
    }
    
    public function getNotificationMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('NotificationMapper');
    }
    
 
    
    public function getRaffleMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('RaffleMapper');
    }
    
    public function getStageMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('StageMapper');
    }
    
    public function getSubbranchMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('SubbranchMapper');
    }
    
    public function getTreatmentMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('TreatmentMapper');
    }
    
    public function getPrizeMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('PrizeMapper');
    }
    
    public function getNameMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('NameMapper');
    }

    public function getSignupMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('SignupMapper');
    }
    public function getLotteryMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('LotteryMapper');
    }
    
    
    
    
    public function indexAction()
    {
        return array();
    }
    public function testmysqlAction()
    {
        return array();
    }
    public function phpinfoAction()
    {
        return array();
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /dec/dec/foo
        return array();
    }
    public function ajaxtestAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /dec/dec/foo
        return array();
    }
    public function picturechoiceajaxAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /dec/dec/foo
        return array('id'=>"123");
    }
    
    //TODO customertoken
    public function customertokenAction()
    {   
        $sub=$this->params('sub');//用户id
        $third=urldecode($this->params('third'));//ios设备号
        
        $customer = $this->getCustomerMapper()->getCustomer1($sub);
        $customer->setCustoken($third);
        $this->getCustomerMapper()->saveCustomer($customer);
        
        return array();
    }
    
    //TODO customertoken
    public function cosmetologisttokenAction()
    {
        $sub=$this->params('sub');//美容师id
        $third=urldecode($this->params('third'));//ios设备号
        
        $cosmetologist = $this->getCosmetologistMapper()->getCosmetologist1($sub);
        $cosmetologist->setCostoken($third);
        $this->getCosmetologistMapper()->saveCosmetologist($cosmetologist);
        
        return array();
    }
    
    //TODO salonbosstoken
    public function salonbosstokenAction()
    {
        $sub=$this->params('sub');//美容院编号salnumber
        $third=urldecode($this->params('third'));//ios设备号
        
        $account = $this->getAccountMapper()->getAccount($sub);
        $account->setSaltoken($third);
        $this->getAccountMapper()->saveAccount($account);
        
        return array();
    }
    
    
    //TODO templatetest
 public function templatetestAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        $third = (string) $this->params('third');
        //链接需要的对象：产品，页面，分类，首页
        $products = $this->getProductMapper()->getProduct($id);
        $pagesactivity = $this->getPageMapper()->getPageactivity($id);
        $pagesalonbranch = $this->getPageMapper()->getPagesalonbranch($id);//美容院分页
        $pagecosmetologist = $this->getPageMapper()->getPagecosmetologist($id);//美容师分页
        
        $demandclassifyseriess = $this->getDemandclassifyseriesMapper()->getDemandclassifyseries2($id);
        //产品详情部分
        
        if($third=="productdetail"){
            $templateitem=$this->getTemplateMapper()->getProductdetail($id,$sub);
            //产品页面的页头，颜色，边距等，没有的话，图片和链接选择框会出错
//             $page = new PageEntity();
//             $page->setPagecolor("black");
//             $page->setPagepaddingbottom(0);
//             $page->setPagepaddinglr(0);
//             $page->setPagepaddingtop(0);
            $page = $this->getPageMapper()->getPage1(33);
            
            $request = $this->getRequest();
            if ($request->isPost()) {
                $post = $request->getPost()->toArray();
                //提交保存模块部分
                $this->getTemplateMapper()->deleteTemplate1($id,$sub);
                for($i=0;$i<count($post["valuearray"]);$i++){
                    $template = new TemplateEntity();
                    $template->setSalnumber($id);
                    $template->setProdid($sub);
                    $template->setTemplateindex($i);
                    $template->setTemplatetype($post["valuearray"][$i][0]);
                    $template->setTemplatedata1($post["valuearray"][$i][1]);
                    $template->setTemplatedata2($post["valuearray"][$i][2]);
                    $template->setTemplatedata3($post["valuearray"][$i][3]);
                    $template->setTemplatedata4($post["valuearray"][$i][4]);
                    $template->setTemplatedata5($post["valuearray"][$i][5]);
                    $template->setTemplatedata6($post["valuearray"][$i][6]);
                    $template->setTemplatedata7($post["valuearray"][$i][7]);
                    $template->setTemplatedata8($post["valuearray"][$i][8]);
                    $template->setTemplatedata9($post["valuearray"][$i][9]);
                    $template->setTemplatedata10($post["valuearray"][$i][10]);
                    $this->getTemplateMapper()->saveTemplate($template);
                }
            }
        }
       
        //page部分
        if($third=="page"){
        $page = $this->getPageMapper()->getPage1($sub);
        $templateitem=$this->getTemplateMapper()->getTemplate($sub);
        $request = $this->getRequest();
        if ($request->isPost()) {
        $post = $request->getPost()->toArray();
        //提交保存页头部分
        $page1 = $this->getPageMapper()->getPage1($sub);
        $pageform=new PageForm();
        $pageform->bind($page1);
        $pageform->setData($post);
        if ($pageform->isValid()) {
            $this->getPageMapper()->savePage($page1);
        }
        //提交保存模块部分
        $this->getTemplateMapper()->deleteTemplate($sub);
        for($i=0;$i<count($post["valuearray"]);$i++){
        $template = new TemplateEntity();
        $template->setSalnumber($id);
        $template->setPageid($sub);
        $template->setTemplateindex($i);
        $template->setTemplatetype($post["valuearray"][$i][0]);
        $template->setTemplatedata1($post["valuearray"][$i][1]);
        $template->setTemplatedata2($post["valuearray"][$i][2]);
        $template->setTemplatedata3($post["valuearray"][$i][3]);
        $template->setTemplatedata4($post["valuearray"][$i][4]);
        $template->setTemplatedata5($post["valuearray"][$i][5]);
        $template->setTemplatedata6($post["valuearray"][$i][6]);
        $template->setTemplatedata7($post["valuearray"][$i][7]);
        $template->setTemplatedata8($post["valuearray"][$i][8]);
        $template->setTemplatedata9($post["valuearray"][$i][9]);
        $template->setTemplatedata10($post["valuearray"][$i][10]);
        $this->getTemplateMapper()->saveTemplate($template);
        }
        }
        }
 return array(
            'id' => $id,
            'sub'=>$sub,
            'third'=>$third,
            'page'=>$page,//传递主题页和模块间距和页面类型
            'templateitem'=>$templateitem,//传递已有的模块
            //链接选择器需要的
            'products'=>$products,
            'pagesactivity'=>$pagesactivity,
            'pagesalonbranch'=>$pagesalonbranch,
            'pagecosmetologist'=>$pagecosmetologist,
            'demandclassifyseriess'=>$demandclassifyseriess
        );
    }
    //TODO productmodule
    public function productmoduleAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        //链接需要的对象：产品，页面，分类，首页
        $products = $this->getProductMapper()->getProduct($id);
        $pages = $this->getPageMapper()->getPage($id);
        $demandclassifyseriess = $this->getDemandclassifyseriesMapper()->getDemandclassifyseries2($id);
    
        $page = $this->getPageMapper()->getPage1($sub);
        $templateitem=$this->getTemplateMapper()->getTemplate($sub);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            //提交保存
            $this->getTemplateMapper()->deleteTemplate($post["valuearray"][0][0]);
            for($i=0;$i<count($post["valuearray"]);$i++){
                $template = new TemplateEntity();
                $template->setSalnumber($id);
                $template->setProdid($post["valuearray"][$i][0]);
                $template->setTemplateindex($i);
                $template->setTemplatetype($post["valuearray"][$i][1]);
                $template->setTemplatedata1($post["valuearray"][$i][2]);
                $template->setTemplatedata2($post["valuearray"][$i][3]);
                $template->setTemplatedata3($post["valuearray"][$i][4]);
                $template->setTemplatedata4($post["valuearray"][$i][5]);
                $template->setTemplatedata5($post["valuearray"][$i][6]);
                $template->setTemplatedata6($post["valuearray"][$i][7]);
                $template->setTemplatedata7($post["valuearray"][$i][8]);
                $template->setTemplatedata8($post["valuearray"][$i][9]);
                $template->setTemplatedata9($post["valuearray"][$i][10]);
                $template->setTemplatedata10($post["valuearray"][$i][11]);
                $this->getTemplateMapper()->saveTemplate($template);
            }
        }
        return array(
            'id' => $id,
            'page'=>$page,
            'post'=>$post,
            'templateitem'=>$templateitem,
            'products'=>$products,
            'pages'=>$pages,
            'demandclassifyseriess'=>$demandclassifyseriess
        );
    }
}
