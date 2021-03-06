<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Customer for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Customer\Controller;

use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Cosmetic\Chatmodule\ChatmoduleForm;
use Cosmetic\Chatmodule\ChatmoduleEntity;
use Cosmetic\Chatmodule\ChatmoduleMapper;
use Cosmetic\Customer\CustomerForm;
use Cosmetic\Customer\CustomerEntity;
use Cosmetic\Treatment\TreatmentForm;
use Cosmetic\Treatment\TreatmentEntity;
use Cosmetic\Appointment\AppointmentForm;
use Cosmetic\Appointment\AppointmentEntity;
use Zend\Session\Container;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService;
use Cosmetic\Saloncouponget\SaloncoupongetEntity;
use Cosmetic\Trolley\TrolleyEntity;
use Zend\Http\Header\SetCookie;
use Cosmetic\Trolley\TrolleyForm;
use Cosmetic\Feedbacks\FeedbacksForm;
use Cosmetic\Feedbacks\FeedbacksEntity;
use Cosmetic\Unread\UnreadEntity;
use Cosmetic\Signup\SignupEntity;
use function Zend\Mvc\Controller\params;

class CusController extends AbstractActionController
{
    // 生成随机文件名
    public function newfilename($length, $filename)
    {
        $temp = explode(".", $filename);
        $extension = end($temp);
        $chars = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
        $hash = '';
        $max = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i ++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        $newfilename = $hash . '.' . $extension;
        return $newfilename;
    }

    public function getTrolleyMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('TrolleyMapper');
    }
    public function getNotificationinfoMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('NotificationinfoMapper');
    }
    public function getSignupMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('SignupMapper');
    }
    public function getUnreadMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('UnreadMapper');
    }

    public function getFeedbacksMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('FeedbacksMapper');
    }

    public function getChatmoduleMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('ChatmoduleMapper');
    }

    public function getCustombuttonMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('CustombuttonMapper');
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

    public function getSalonMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('SalonMapper');
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

    public function getCustomerMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('CustomerMapper');
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

    public function getProductMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('ProductMapper');
    }

    public function getProductcombinationMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('ProductcombinationMapper');
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

    public function getSalonslideMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('SalonslideMapper');
    }

    public function getSalonbuttonMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('SalonbuttonMapper');
    }

    public function getDemandclassifyseriesMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('DemandclassifyseriesMapper');
    }
    // TODO index
    public function indexAction()
    {
        
        return new ViewModel();
    }
    // TODO register
    public function registerAction()
    {
        $container = new Container('customerregister');
        $cusverification = $container->cusverification;
        $cusregisterphone = $container->cusregisterphone;
        
        
        $sub = $this->params('sub'); // 美容院id
        
        $homepage = $homepage = $this->getPageMapper()->getHomepage($sub); // 美容院标识
        
        $form = new CustomerForm();
        $entity = new CustomerEntity();
        $form->bind($entity);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
         if ($cusverification){
          if ($_POST['registerverification']==$cusverification&&$_POST['cusphone']==$cusregisterphone){
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $sub;
            
            //判断手机号是否已存在
            $existcustomer=$this->getCustomerMapper()->getCustomerexist($post['cusphone']);
            if ($existcustomer){
                return array(
                    'form' => $form,
                     'homepage' => $homepage,
                     'existcustomer'=>$existcustomer,
                     'sub' => $sub);
            }
            
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getCustomerMapper()->saveCustomer($entity);
                //取出此顾客，并将unread改为cus+cusid形式
                $cusunread=$this->getCustomerMapper()->getCustomerlogin($_POST['cusphone'],$_POST['cuspassword']);
                $cusunread->setUnread("cus".$cusunread->getCusid());
                $this->getCustomerMapper()->saveCustomer($cusunread);
                
                if (! file_exists('public/portrait')) {
                    mkdir('public/portrait');
                }
                //图片缩放
                $pname = iconv('utf-8', 'gbk', $x['cusphoto']);//文件名
                $pname1=iconv('utf-8', 'gbk', 'public/portrait/');//文件路径
                $pname2=iconv('utf-8', 'gbk', $y['cusphotof']['tmp_name']);//临时文件名
                //move_uploaded_file($y['cusphotof']['tmp_name'], 'public/portrait/' . $x['cusphoto']);
                //缩放
                $temp = explode(".", $pname);
                $extension = end($temp);
                
                //视频文件直接保存,图片按后缀缩放
                if ($extension=="mp4"){
                    move_uploaded_file($pname2, $pname1.$pname);
                }elseif($extension=="jpg"||$extension=="jpeg"||$extension=="gif"||$extension=="png"){
                    $filename=$pname2;
                    list($width, $height)=getimagesize($filename);
                    if ($width>200||$height>200){//长或宽大于500则缩放
                        //缩放比例
                        $per=round(100/$width,3);
                
                        $n_w=$width*$per;
                        $n_h=$height*$per;
                        $new=imagecreatetruecolor($n_w, $n_h);
                
                        switch ($extension){
                            case "jpg":
                                $img=imagecreatefromjpeg($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagejpeg($new, $pname1.$pname);
                                break;
                            case "jpeg":
                                $img=imagecreatefromjpeg($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagejpeg($new, $pname1.$pname);
                                break;
                            case "gif":
                                $img=imagecreatefromgif($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagegif($new, $pname1.$pname);
                                break;
                            case "png":
                                $img=imagecreatefrompng($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagepng($new, $pname1.$pname);
                                break;
                        }
                        imagedestroy($new);
                        imagedestroy($img);
                
                    }else{
                        move_uploaded_file($pname2, $pname1.$pname);
                    }
                
                }
                
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('customer', array(
                    'action' => 'login',
                    'sub' => $sub
                ));
            }
          }else{
              return array(
                  'form' => $form,
                  'homepage' => $homepage,
                  'verificationwrong'=>"验证码错误",
                  'sub' => $sub
              );
          }}else{
              return array(
                  'form' => $form,
                  'homepage' => $homepage,
                  'verificationwrong'=>"验证码错误",
                  'sub' => $sub
              );
          };
        }
        
        // 返回已有的账号  作废
        //$customers = $this->getCustomerMapper()->fetchAll();
        return array(
            'form' => $form,
            'homepage' => $homepage,
            //'customers' => $customers,
            'sub' => $sub
        );
    }
    
    
    //TODO 注册验证码
    public function registerverificationAction(){
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $cusname = $container->cusname;
        $cusphone = $container->cusphone;
    }
    
    // TODO reset
    public function resetAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $cusname = $container->cusname;
        $cusphone = $container->cusphone;
        
    
        $homepage = $homepage = $this->getPageMapper()->getHomepage($id); // 美容院标识
    
        $entity=$this->getCustomerMapper()->getCustomer1($cusid);
        
        $form = new CustomerForm();
        $form->bind($entity);
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            
            
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getCustomerMapper()->saveCustomer($entity);
                if (! file_exists('public/portrait')) {
                    mkdir('public/portrait');
                }
                //图片缩放
                $pname = iconv('utf-8', 'gbk', $x['cusphoto']);//文件名
                $pname1=iconv('utf-8', 'gbk', 'public/portrait/');//文件路径
                $pname2=iconv('utf-8', 'gbk', $y['cusphotof']['tmp_name']);//临时文件名
                //move_uploaded_file($y['cusphotof']['tmp_name'], 'public/portrait/' . $x['cusphoto']);
                //缩放
                $temp = explode(".", $pname);
                $extension = end($temp);
                
                //视频文件直接保存,图片按后缀缩放
                if ($extension=="mp4"){
                    move_uploaded_file($pname2, $pname1.$pname);
                }elseif($extension=="jpg"||$extension=="jpeg"||$extension=="gif"||$extension=="png"){
                    $filename=$pname2;
                    list($width, $height)=getimagesize($filename);
                    if ($width>200||$height>200){//长或宽大于500则缩放
                        //缩放比例
                        $per=round(100/$width,3);
                        
                        $n_w=$width*$per;
                        $n_h=$height*$per;
                        $new=imagecreatetruecolor($n_w, $n_h);
                        
                        switch ($extension){
                            case "jpg":
                                $img=imagecreatefromjpeg($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagejpeg($new, $pname1.$pname);
                                break;
                            case "jpeg":
                                $img=imagecreatefromjpeg($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagejpeg($new, $pname1.$pname);
                                break;
                            case "gif":
                                $img=imagecreatefromgif($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagegif($new, $pname1.$pname);
                                break;
                            case "png":
                                $img=imagecreatefrompng($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagepng($new, $pname1.$pname);
                                break;
                        }
                        imagedestroy($new);
                        imagedestroy($img);
                        
                    }else{
                        move_uploaded_file($pname2, $pname1.$pname);
                    }
                    
                }
    
                // Redirect to list of tasks
                return $this->redirect()->toRoute('customer', array(
                    'action' => 'login',
                    'sub' => $id
                ));
            }
        }
    
        // 返回已有的账号 作废
        //$customers = $this->getCustomerMapper()->fetchAll();
        return array(
            'form' => $form,
            'homepage' => $homepage,
            //'customers' => $customers,
            'sub' => $id,
            'cusphone'=>$cusphone
        );
    }
    // TODO login
    // webview似乎不需要cookie
    // 直接进入登陆界面，判断，如果没cookie，则保持登陆页面，登陆并设置cookie和session，然后跳转首页
    // 如果有cookie，则设置session,并跳转首页
    // *似乎加了$sub之后，页面之间就不能传递cookie了,cookie只属于login页面
    // 页面加载2次才能判断cookie不存在
    public function loginAction()
    {
        $sub = $this->params('sub'); // 美容院id
        
        $homepage = $homepage = $this->getPageMapper()->getHomepage($sub); // 美容院标识
        
        $form = new CustomerForm();
                
        $request = $this->getRequest();
        
        
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            // $salarray->cusname，返回中文有乱码，按id创建cutomer对象，再调用getCusname();
            $customer = $this->getCustomerMapper()->getCustomer2($post['cusphone'],$post['cuspassword']);
                if ($customer) {
                   
                    
                    // 设置session
                    $container = new Container('customerlogin');
                    $container->salnumber = $sub;
                    $container->cusid = $customer->getCusid();
                    $container->cusname = $customer->getCusname();
                    $container->cusphone = $customer->getCusphone();
                    $container->cusphoto = $customer->getCusphoto();

                    return $this->redirect()->toRoute('customer', array(
                        'action' => 'homepage',
                        'sub' => $sub,
                        'third'=>"login"
                    ));
                } else {
                    return array(
                         'form' => $form,
                         'sub' => $sub,
                         'homepage' => $homepage,
                         'result'=>"账号或密码错误"
                        );
                    
                }
           
        };
        

        return array(
            'form' => $form,
            'sub' => $sub,
            'homepage' => $homepage
        );
    }
    
    // TODO homepage
    public function homepageAction()
    {
        $sub = $this->params('sub'); // 美容院id，或者活动和动态页面的跳转
        $third=$this->params('third');//判断是否是登录页的跳转
                                     
        // 先判断session是否存在，不存在，则跳转到登录页，存在，则继续
                                     // 原来是$this->getRequest()->getCookie()->salnumber;
                                   // 设置session
        if($third=="login"){
            //取出session
            $container = new Container('customerlogin');
            $id = $container->salnumber;
            $cusid = $container->cusid;
            $cusname = $container->cusname;
            $cusphone = $container->cusphone;
            $cusphoto = $container->cusphoto;
        // 设置cookie
        $expire=time()+60*60*24*30;
        setcookie("salnumber", $id, $expire);
        setcookie("cusid", $cusid, $expire);
        setcookie("cusname", $cusname, $expire);
        setcookie("cusphone", $cusphone, $expire);
        setcookie("cusphoto",$cusphoto,$expire);
        }else{
            //按cookie设session
                    $container = new Container('customerlogin');
                    $container->salnumber = $_COOKIE['salnumber'];
                    $container->cusid = $_COOKIE['cusid'];
                    $container->cusname = $_COOKIE['cusname'];
                    $container->cusphone = $_COOKIE['cusphone'];
                    $container->cusphoto = $_COOKIE['cusphoto'];
                    
                    $id = $container->salnumber;
                    $cusid = $container->cusid;
                    $cusname = $container->cusname;
                    $cusphone = $container->cusphone;
                    $cusphoto = $container->cusphoto;
                    //为了反馈页跳转，因为只有首页才能读取cookie，所以先跳转首页，再转反馈页
                    if($third=="feedbacks"){
                        $container->treid=$_GET['treid'];
                        $container->cosid=$_GET['cosid'];
                        return $this->redirect()->toRoute('customer', array(
                            'action' => 'feedbacks',
                        ));
                    }
        }
        if(!$cusid){
            return $this->redirect()->toRoute('customer', array(
                'action' => 'login',
                'sub' => $sub
            ));
        }
        
       
            //$activitypages = $this->getPageMapper()->getActivitypages($id, "活动");
            //$dynamicpages = $this->getPageMapper()->getActivitypages($id, "动态");
            $homepage = $this->getPageMapper()->getHomepage($id);
            $template = $this->getTemplateMapper()->getTemplate($homepage->getPageid());
            
            //$products = $this->getProductMapper()->getProduct($id);
            //未读信息
            $unread=$this->getUnreadMapper()->getTask1("cus".$cusid);
            $unreadsum=0;
            foreach ($unread as $unreadone){
                $unreadsum=$unreadsum+$unreadone->getNumber();
            }
            // 自定义按钮
            $custombuttons = $this->getCustombuttonMapper()->getCustombuttons($id);
            return array(
                'third'=>$third,
                'id' => $id,
                'cusid' => $cusid,
                'cusname' => $cusname,
                'cusphone' => $cusphone,
                'page' => $homepage,
                'templateitem' => $template,
                //'products' => $products,
                //'activitypages' => $activitypages,
                //'dynamicpages' => $dynamicpages,
                'custombuttons' => $custombuttons,
                'salnumber' => $_COOKIE['salnumber'],
                'unreadsum'=>$unreadsum
            );
    }
    
    //homepage的产品，活动，动态 ajax页
    public function homepagetwoAction(){
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        
        $products = $this->getProductMapper()->getProduct($id);
        
        return array('products' => $products);
        
    }
    public function homepagethreeAction(){
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $homepage = $this->getPageMapper()->getHomepage($id);
        $activitypages = $this->getPageMapper()->getActivitypages($id, "活动");
        
        return array('activitypages' => $activitypages,'page' => $homepage,);
        
    }
    public function homepagefourAction(){
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $homepage = $this->getPageMapper()->getHomepage($id);
        $dynamicpages = $this->getPageMapper()->getActivitypages($id, "动态");
        
        return array('dynamicpages' => $dynamicpages,'page' => $homepage,);
    }
    // TODO productlist
    public function productlistAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $cusname = $container->cusname;
        $cusphone = $container->cusphone;
        
        $products = $this->getProductMapper()->getProduct($id);
        return array(
            'id' => $id,
            'cusid' => $cusid,
            'cusname' => $cusname,
            'cusphone' => $cusphone,
            'products' => $products
        );
    }
    // TODO productitem
    public function productitemAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $sub = $this->params('sub'); // 产品id
        $entity = new TrolleyEntity();
        $product = $this->getProductMapper()->getProduct1($sub); // 产品
        $productcombinations = $this->getProductcombinationMapper()->getProductcombination($id, $sub);
        // 详情部分
        $page = $this->getPageMapper()->getPage1("33");
        $templateitem = $this->getTemplateMapper()->getProductdetail($id, $sub);
        // 优惠券
        $saloncouponissues = $this->getSaloncouponissueMapper()->getSaloncouponissue3($id, $cusid);
        //评价
        $feedbacks=$this->getFeedbacksMapper()->getFeedbacksonprodid($sub);
        //店长
        $salonmanager=$this->getCosmetologistMapper()->getSalonmanager($id);
        return array(
            'id' => $id,
            'cusid' => $cusid,
            'sub' => $sub,
            'product' => $product,
            'productcombinations' => $productcombinations,
            'page' => $page,
            'templateitem' => $templateitem,
            'saloncouponissues' => $saloncouponissues,
            'feedbacks'=>$feedbacks,
            'salonmanager'=>$salonmanager
        );
    }
    
    // TODO activitylist
    public function activitylistAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $sub = (string) $this->params('sub');
        $activitypages = $this->getPageMapper()->getActivitypages($id, "活动");
        switch ($sub) {
            case "activity":
                $activitypages = $this->getPageMapper()->getActivitypages($id, "活动");
                break;
            case "dynamic":
                $activitypages = $this->getPageMapper()->getActivitypages($id, "动态");
                break;
        }
        return array(
            'id' => $id,
            'activitypages' => $activitypages,
            'sub' => $sub
        );
    }
    // TODO activityajax
    public function activityajaxAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $page = $this->getPageMapper()->getPage1($post['pageid']);
            $template = $this->getTemplateMapper()->getTemplate($post['pageid']);
        }
        return array(
            'id' => $id,
            'page' => $page,
            'template' => $template
        );
    }
    
    // TODO activityitem
    public function activityitemAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $sub = (string) $this->params('sub');
        
        $signupstate="no";
        $page = $this->getPageMapper()->getPage1($sub);
        //是活动则看是否已参加
        if($page->getPagetype()=="活动"){
            if($this->getSignupMapper()->getTask1($cusid,$page->getPageid())){
            $signupstate="yes";
            }
        }
        $template = $this->getTemplateMapper()->getTemplate($sub);
        return array(
            'id' => $id,
            'page' => $page,
            'templateitem' => $template,
            'signupstate'=>$signupstate
        );
    }
    
    // TODO 预约
    public function appointmentAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $cusname = $container->cusname;
        $cusphone = $container->cusphone;
        $test = $container->test;
        
        $customer = $this->getCustomerMapper()->getCustomer1($cusid);
        
        $form = new AppointmentForm();
        $appointment = new AppointmentEntity();
        
        $form->bind($appointment);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $post['cusid'] = $cusid;
            $post['cusname'] = $cusname;
            $post['cusphone'] = $cusphone;
            $post['appointmentstate'] = "预约中";
            $timestamp=strtotime($post['appointmentdate']." ".$post['appointmenttime'].":00");
            $timecomparison=date('YmdHis', $timestamp);
            $appointment->setTimecomparison($timecomparison);
            $appointment->setAppointmentdatetime($post['appointmentdate']." ".$post['appointmenttime'].":00");
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getAppointmentMapper()->saveAppointment($appointment);
            }
        }
        $mapper = $this->getSalonMapper();
        //未读信息
        $unread=$this->getUnreadMapper()->getTask1("cus".$cusid);
        $unreadsum=0;
        foreach ($unread as $unreadone){
            $unreadsum=$unreadsum+$unreadone->getNumber();
        }
        $homepage = $this->getPageMapper()->getHomepage($id);//为了获取首页颜色设置
        return new ViewModel(array(
            'container' => $container,
            'salons' => $mapper->getSalon($id),
            'id' => $id,
            'form' => $form,
            'cusid' => $cusid,
            'cusname' => $cusname,
            'recentdate' => $this->getAppointmentMapper()->getAppointmentRecentDate1($id, $cusid),
            'unreadsum'=>$unreadsum,
            'homepage'=>$homepage
        )
        );
    }
    // TODO 预约ajax
    public function appointmentselectajaxAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $cosmetologists = $this->getCosmetologistMapper()->getCosmetologistBranch($id, $post['salonBranchValue']);
        }
        return new ViewModel(array(
            'container' => $container,
            'cosmetologists' => $cosmetologists,
            'id' => $id
        ));
    }

    public function appointmentdeleteAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $appointment = $this->getAppointmentMapper()->getAppointment1($sub);
        if (! $appointment) {
            return $this->redirect()->toRoute('customer', array(
                'action' => 'me'
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getAppointmentMapper()->deleteAppointment($sub);
            }
            
            return $this->redirect()->toRoute('customer', array(
                'action' => 'myappointments','sub'=>'unexpired'
            ));
        }
        return array(
            'id' => $id,
            'sub' => $sub,
            'appointment' => $appointment
        );
    }
    
    // TODO 美容师
    public function cosmetologistAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        
        
        $homepage = $this->getPageMapper()->getHomepage($id);//为了获取首页颜色设置
        //获取此顾客为接收方的所有未读            发送方为某美容师，则显示未读数  每个未读只能循环一次，所有分别取
        $receiveunread=$this->getUnreadMapper()->getTask1('cus'.$cusid);
        
        $mapper1 = $this->getCosmetologistMapper();
        $mapper2 = $this->getSalonMapper();
        //未读信息
        $unread=$this->getUnreadMapper()->getTask1("cus".$cusid);
        $unreadsum=0;
        foreach ($unread as $unreadone){
            $unreadsum=$unreadsum+$unreadone->getNumber();
        }
        return new ViewModel(array(
            'cosmetologists' => $mapper1->getCosmetologist($id),
            'salons' => $mapper2->getSalon($id),
            'id' => $id,
            'receiveunread'=>$receiveunread,
            'unreadsum'=>$unreadsum,
            'homepage'=>$homepage
        ));
    }
    
    //TODO 浏览记录的ajax
    public function cusbrowsingajaxAction(){
        return array();
    }
    
    
    // TODO 领取优惠券
    public function saloncoupongetajaxAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $entity = new SaloncoupongetEntity();
        $request = $this->getRequest();
        $post = $request->getPost()->toArray();
        // 查看此优惠券限制次数
        $scitimes = $this->getSaloncouponissueMapper()
            ->getSaloncouponissue1($post["sciid"])
            ->getScitimes();
        // 当前客户已有此优惠券的个数
        $saloncouponget1s = $this->getSaloncoupongetMapper()->getSaloncouponget1($cusid, $post["sciid"]);
        $cars = array();
        foreach ($saloncouponget1s as $saloncouponget1) {
            array_push($cars, $saloncouponget1->getScgid());
        }
        $scgtimes = count($cars);
        // 对比
        if ($scitimes > $scgtimes) {
            $entity->setCusid($cusid);
            $entity->setSciid($post["sciid"]);
            $entity->setSalnumber($id);
            $entity->setScgstate("unused");
            $entity->setScimoney($post["scimoney"]);
            $this->getSaloncoupongetMapper()->saveSaloncouponget($entity);
            return array(
                'couponResult' => "领取成功",
                'scitimes' => $scitimes,
                'scgtimes' => $scgtimes
            );
        } else {
            return array(
                'couponResult' => "领取已达上限",
                'scitimes' => $scitimes,
                'scgtimes' => $scgtimes
            );
        }
    }
    
    // TODO 购物车
    public function trolleyAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        
        $trolleys = $this->getTrolleyMapper()->getTrolleys($cusid);
        
        return new ViewModel(array(
            'trolleys' => $trolleys,
            'id' => $id
        ));
    }

    public function trolleydeleteAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $trolley = $this->getTrolleyMapper()->getTrolley($sub);
        if (! $trolley) {
            return $this->redirect()->toRoute('customer', array(
                'action' => 'trolley'
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getTrolleyMapper()->deleteTrolley($sub);
            }
            
            return $this->redirect()->toRoute('customer', array(
                'action' => 'trolley'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'trolley' => $trolley
        );
    }

    public function trolleyaddAction()
    {
        $form = new TrolleyForm();
        $entity = new TrolleyEntity();
        $form->bind($entity);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getTrolleyMapper()->saveTrolley($entity);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('customer');
            }
        }
        
        return array(
            'form' => $form
        );
    }

    public function trolleyaddajaxAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        
        $entity = new TrolleyEntity();
        
        $request = $this->getRequest();
        $post = $request->getPost()->toArray();
        
        $entity->setSalnumber($id);
        $entity->setCusid($cusid);
        $entity->setProdid($post['prodid']);
        $entity->setProdtitle($post['prodtitle']);
        $entity->setProductcombinationid($post['productcombinationid']);
        $entity->setProductcombinationprice($post['productcombinationprice']);
        $entity->setProductcombinationpicture($post['productcombinationpicture']);
        $entity->setProductcombinationname($post['productcombinationname']);
        $entity->setProductquantity($post['productquantity']);
        $entity->setTrolleydate(date('Y-m-d H:i:s'));
        $result = $this->getTrolleyMapper()->saveTrolley($entity);
        return array(
            'result' => "添加成功"
        );
    }
    
   // TODO 聊天
    public function chatAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $sub = $this->params('sub');//美容师id
         // 自己和美容师
        $cosmetologist = $this->getCosmetologistMapper()->getCosmetologist1($sub);
        $customer = $this->getCustomerMapper()->getCustomer1($cusid);
        //判断对方给我的未读条目是否存在，不存在则新建
        if(!$this->getUnreadMapper()->getTask('cos'.$cosmetologist->getCosid(),'cus'.$customer->getCusid())){
            //新建未读
            $unreadentity=new UnreadEntity();
            $unreadentity->setSendid('cos'.$cosmetologist->getCosid());
            $unreadentity->setReceiveid('cus'.$customer->getCusid());
            $unreadentity->setReceiveid('cus'.$customer->getCusid());
            $this->getUnreadMapper()->saveTask($unreadentity);
        }
        //判断我给对方的未读条目是否存在，不存在则新建
        if(!$this->getUnreadMapper()->getTask('cus'.$customer->getCusid(),'cos'.$cosmetologist->getCosid())){
            //新建未读
            $unreadentity=new UnreadEntity();
            $unreadentity->setSendid('cus'.$customer->getCusid());
            $unreadentity->setReceiveid('cos'.$cosmetologist->getCosid());
            $this->getUnreadMapper()->saveTask($unreadentity);
        }
        
         //加载最近的20条
        $chatmodule = $this->getChatmoduleMapper()->fetchAllbegin('cus' . $customer->getCusid(), 'cos' . $cosmetologist->getCosid());
        //未读清零
        //对方给自己的未读条目数，每次刷新要清0
        $receiveunread=$this->getUnreadMapper()->getTask('cos'.$cosmetologist->getCosid(),'cus'.$customer->getCusid());
        $receiveunread->setNumber(0);
        $this->getUnreadMapper()->saveTask($receiveunread);
        
        
        $form = new ChatmoduleForm();
        
        return array(
            'id'=>$id,
            'form' => $form,
            'cusid'=>$cusid,
            'customer' => $customer,
            'sub'=>$sub,
            'unread'=>$customer->getUnread(),
            'chatmodule'=>$chatmodule,
            'cosmetologist'=>$cosmetologist
        );
    }

    //聊天记录
    public function chathistoryAction(){
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $sub = $this->params('sub');//美容师id
        // 自己和美容师
        $cosmetologist = $this->getCosmetologistMapper()->getCosmetologist1($sub);
        $customer = $this->getCustomerMapper()->getCustomer1($cusid);
        
        //记录
        if ($_GET['searching']==null){
        $chatmodule = $this->getChatmoduleMapper()->fetchAlldate('cus' . $customer->getCusid(), 'cos' . $cosmetologist->getCosid(),date("Ymd"));
        }else {
        $searchingstamp=strtotime($_GET['searching']);
        $searchingdate=date("Ymd",$searchingstamp);
        $chatmodule = $this->getChatmoduleMapper()->fetchAlldate('cus' . $customer->getCusid(), 'cos' . $cosmetologist->getCosid(),$searchingdate);
        }
         
        return array(
            'cusid'=>$cusid,
            'customer' => $customer,
            'sub'=>$sub,
            'unread'=>$customer->getUnread(),
            'chatmodule'=>$chatmodule,
            'cosmetologist'=>$cosmetologist
        );
    }
    
    
public function chatajaxAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $cusname = $container->cusname;
        $sub = $this->params('sub');
    
        
        // 自己和美容师
        $cosmetologist = $this->getCosmetologistMapper()->getCosmetologist1($sub);
        $customer = $this->getCustomerMapper()->getCustomer1($cusid);
        //给对方的信息,每发送一次要加1
        $sendunread=$this->getUnreadMapper()->getTask('cus'.$customer->getCusid(),'cos'.$cosmetologist->getCosid());
        //对方给自己的未读条目数，每次刷新要清0
        $receiveunread=$this->getUnreadMapper()->getTask('cos'.$cosmetologist->getCosid(),'cus'.$customer->getCusid());
        
        $entity = new ChatmoduleEntity();
    
        $request = $this->getRequest();
    
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            if ($y['chatpicture']['name'] !== null) {
                if (! file_exists('public/chatpicture')) {
                    mkdir('public/chatpicture');
                }
                //$pname = iconv('utf-8', 'gbk', $y['chatpicture']['name']);
                $newfilename = $this->newfilename(15, iconv('utf-8', 'gbk', $y['chatpicture']['name']));
    
                //move_uploaded_file($y['chatpicture']['tmp_name'], 'public/chatpicture/' . $newfilename);
    
                //图片缩放
                $pname = iconv('utf-8', 'gbk', $newfilename);//文件名
                $pname1=iconv('utf-8', 'gbk', 'public/chatpicture/');//文件路径
                $pname2=iconv('utf-8', 'gbk', $y['chatpicture']['tmp_name']);//临时文件名
                //move_uploaded_file($y['cusphotof']['tmp_name'], 'public/portrait/' . $x['cusphoto']);
                //缩放
                $temp = explode(".", $pname);
                $extension = end($temp);
                
                //视频文件直接保存,图片按后缀缩放
                if ($extension=="mp4"){
                    move_uploaded_file($pname2, $pname1.$pname);
                }elseif($extension=="jpg"||$extension=="jpeg"||$extension=="gif"||$extension=="png"){
                    $filename=$pname2;
                    list($width, $height)=getimagesize($filename);
                    if ($width>500||$height>500){//长或宽大于500则缩放
                        //缩放比例
                        $per=round(400/$width,3);
                
                        $n_w=$width*$per;
                        $n_h=$height*$per;
                        $new=imagecreatetruecolor($n_w, $n_h);
                
                        switch ($extension){
                            case "jpg":
                                $img=imagecreatefromjpeg($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagejpeg($new, $pname1.$pname);
                                break;
                            case "jpeg":
                                $img=imagecreatefromjpeg($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagejpeg($new, $pname1.$pname);
                                break;
                            case "gif":
                                $img=imagecreatefromgif($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagegif($new, $pname1.$pname);
                                break;
                            case "png":
                                $img=imagecreatefrompng($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagepng($new, $pname1.$pname);
                                break;
                        }
                        imagedestroy($new);
                        imagedestroy($img);
                
                    }else{
                        move_uploaded_file($pname2, $pname1.$pname);
                    }
                }
                
                
                
                $entity->setChatpicture($newfilename);
                $entity->setReceiveid('cos'.$cosmetologist->getCosid());
                $entity->setSendid('cus'.$customer->getCusid());
    
                $this->getChatmoduleMapper()->saveChat($entity);
     
              
                //给对方添加一条未读,并输入自己现在的名字，防止改名后未读信息不改名,
                $sendunread->setNumber($sendunread->getNumber()+1);//未读
                $sendunread->setSendname($cusname);//发送者名
                $sendunread->setLastword("[图片]");//最后的话
                $this->getUnreadMapper()->saveTask($sendunread);
                
                
                // 获取一条聊天记录
                $chatmodule = $this->getChatmoduleMapper()->fetchAllone('cus'.$customer->getCusid(),'cos'.$cosmetologist->getCosid());
            } else
            if($_POST['chatword']!==""&&$_POST['chatword']!=="[refresh]"){
                $entity->setReceiveid('cos'.$cosmetologist->getCosid());
                $entity->setSendid('cus'.$customer->getCusid());
                $entity->setChatword($_POST['chatword']);
    
                $this->getChatmoduleMapper()->saveChat($entity);
            
                //给对方添加一条未读,并输入自己现在的名字，防止改名后未读信息不改名,
                $sendunread->setNumber($sendunread->getNumber()+1);//未读
                $sendunread->setSendname($cusname);//发送者名
                $sendunread->setLastword($_POST['chatword']);//最后的话
                $this->getUnreadMapper()->saveTask($sendunread);
                // 获取一条聊天记录
                $chatmodule = $this->getChatmoduleMapper()->fetchAllone('cus'.$customer->getCusid(),'cos'.$cosmetologist->getCosid());
                
            }
            if($_POST['chatword']=="[refresh]"){
                // 获取对方给自己的未读信息
                if($receiveunread->getNumber()+0>0){
                    $chatmodule = $this->getChatmoduleMapper()->fetchAllunread('cos'.$cosmetologist->getCosid(),'cus'.$customer->getCusid(),$receiveunread->getNumber()+0);
                    //设自己接受的未读信息为0
                    $receiveunread->setNumber(0);
                    $this->getUnreadMapper()->saveTask($receiveunread);
                }
            }
            
        }
    
       
    
        return array(
            'chatmodule' => $chatmodule,
            'cusid' => $cusid,
            'sub' => $sub,
            'cosmetologist' => $cosmetologist,
            'customer' => $customer,
            'receiveunread'=>$receiveunread
        );
    }
    // TODO me
    public function meAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $cusname = $container->cusname;
        $cusphone = $container->cusphone;
        
        $customer=$this->getCustomerMapper()->getCustomer1($cusid);
        //未读信息
        $unread=$this->getUnreadMapper()->getTask1("cus".$cusid);
        $unreadsum=0;
        foreach ($unread as $unreadone){
            $unreadsum=$unreadsum+$unreadone->getNumber();
        }
        
        $homepage = $this->getPageMapper()->getHomepage($id);//为了获取首页颜色设置
        return array(
            'id' => $id,
            'cusid' => $cusid,
            'cusname' => $cusname,
            'cusphone' => $cusphone,
            'customer'=>$customer,
            'unreadsum'=>$unreadsum,
            'homepage'=>$homepage
        );
    }
    //订单
    public function myordersAction()
    {
        $treview=$this->params("sub");
        
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $cusname = $container->cusname;
        $cusphone = $container->cusphone;
        //订单
        $myorders=$this->getTreatmentMapper()->getTreatment2($cusid);
        
        return array(
            'id' => $id,
            'myorders'=>$myorders,
            'treview'=>$treview
        );
    }
    //订单详情
    public function myorderdetailAction()
    { 
        //订单id
        $sub=$this->params('sub');
        
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $cusname = $container->cusname;
        $cusphone = $container->cusphone;
        //订单
        $myorder=$this->getTreatmentMapper()->getTreatment1($sub);
        if ($myorder->getTrestate()=="paid"){
            //提取反馈
            $feedbacks=$this->getFeedbacksMapper()->getTask2($myorder->getTreid());
        }
    
        return array(
            'id' => $id,
            'myorder'=>$myorder,
            'feedbacks'=>$feedbacks
        );
    }
    //反馈详情
    public function myfeedbackAction()
    {
        //订单id
        $sub=$this->params('sub');
    
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $cusname = $container->cusname;
        $cusphone = $container->cusphone;
        
        $homepage = $homepage = $this->getPageMapper()->getHomepage($id); // 美容院标识
        
        $feedback=$this->getFeedbacksMapper()->getTask($sub);//反馈
    
        
        return array(
            'id' => $id,
            'feedback'=>$feedback,
            'homepage'=>$homepage
        );
    }
    //预约
    public function myappointmentsAction()
    {
        $sub=$this->params('sub');
        
    
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $cusname = $container->cusname;
        $cusphone = $container->cusphone;
        //预约
        $myappointments=$this->getAppointmentMapper()->getMyappointments($cusid);
    
        return array(
            'id' => $id,
            'myappointments'=>$myappointments,
            'sub'=>$sub
        );
    }
    //预约详情
    public function myappointmentdetailAction()
    {
        //预约id
        $sub=$this->params('sub');
    
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $cusname = $container->cusname;
        $cusphone = $container->cusphone;
        //预约
        $myappointment = $this->getAppointmentMapper()->getAppointment1($sub);
        
        //美容师
        $cosmetologist=$this->getCosmetologistMapper()->getCosmetologist1($myappointment->getCosid());
    
        //美容院分院,获取最近30次评星，并计算平均值
        $salonbranch=$this->getSalonMapper()->getSalonpicute($id,$myappointment->getSalbranch());
        $salfeedbacks=$this->getFeedbacksMapper()->getTask111($id,$myappointment->getSalbranch());
        $salcars=array();
        foreach ($salfeedbacks as $salfeedback){
            array_push($salcars,array("salstar"=>$salfeedback->getFbsurrounding()));
        }
        $saltotal=0;
        foreach($salcars as $car){
            $saltotal=$saltotal+$car['salstar'];
        }
        //如果还没有评价，初始值为4
        if(count($salcars)!=0){
        $salaveragestar=$saltotal/count($salcars);
        }else{$salaveragestar=4;}
        
        //获取美容师最近30次评星,并计算平均值
        $cosfeedbacks=$this->getFeedbacksMapper()->getTask11($myappointment->getCosid());
        //转为数组
        $coscars=array();
        foreach ($cosfeedbacks as $cosfeedback){
        array_push($coscars,array("cosstar"=>$cosfeedback->getFbcosmetologist()));
        }
        $costotal=0;
        foreach($coscars as $car){
            $costotal=$costotal+$car['cosstar'];
        }
        //如果还没有评价，初始值为4
        if(count($coscars)!=0){
            $cosaveragestar=$costotal/count($coscars);
        }else{$cosaveragestar=4;}
       
        
        return array(
            'sub' => $sub,
            'myappointment'=>$myappointment,
            'cosmetologist'=>$cosmetologist,
            'salbranch'=>$salonbranch,
            'cosaveragestar'=>$cosaveragestar,
            'salaveragestar'=>$salaveragestar
        );
    }
    //美容师评星
    public function CosaveragestarAction(){
        //美容师id
        $sub=$this->params('sub');
        //美容师
        $cosmetologist=$this->getCosmetologistMapper()->getCosmetologist1($sub);
        //获取美容师最近30次评星,并计算平均值
        $cosfeedbacks=$this->getFeedbacksMapper()->getTask11($sub);
        //转为数组
        $coscars=array();
        foreach ($cosfeedbacks as $cosfeedback){
            array_push($coscars,array("cosstar"=>$cosfeedback->getFbcosmetologist()));
        }
        $costotal=0;
        foreach($coscars as $car){
            $costotal=$costotal+$car['cosstar'];
        }
        //如果还没有评价，初始值为4
        if(count($coscars)!=0){
            $cosaveragestar=$costotal/count($coscars);
        }else{$cosaveragestar=4;}
        
        return array(
            'sub'=>$sub,
            'cosaveragestar'=>$cosaveragestar
        );
        
    }
    //活动
    public function myactivitiesAction()
    {
    
        $sub=$this->params('sub');
    
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $cusname = $container->cusname;
        $cusphone = $container->cusphone;
        
        $homepage = $this->getPageMapper()->getHomepage($id);//为了获取首页颜色设置
        //美容院的全部活动
        $activitypages = $this->getPageMapper()->getActivitypages($id, "活动");
        //客户参加的全部活动
        $myactivities=$this->getSignupMapper()->getCusActivities($cusid);
    
        return array(
            'id' => $id,
            'sub'=>$sub,
            'myactivities'=>$myactivities,
            'activitypages'=>$activitypages,
            'homepage'=>$homepage
        );
    }
    // TODO foo
    public function fooAction()
    {
        $cars=array("Volvo","BMW","Toyota","Volvo","BMW","Toyota","Volvo","BMW","Toyota","Volvo","BMW","Toyota","Volvo","BMW","Toyota","Volvo","BMW","Toyota","Volvo","BMW","Toyota","Volvo","BMW","Toyota","Volvo","BMW","Toyota");
        $paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($cars));
        $paginator->setCurrentPageNumber($this->params()->fromRoute('sub'));
        
        $vm = new ViewModel();
        $vm->setVariable('paginator', $paginator);
        return $vm;
    }
    // TODO order
    public function orderAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        // 优惠券,先按美容院，价格，时间，客户，搜索符合条件的已发布的优惠券
        $salcoupons = $this->getSaloncouponissueMapper()->getSaloncouponissue4($id, $cusid, $_POST['productcombinationprice']);
        // 每种优惠券获取一张
        $coupongetarray = array();
        
        foreach ($salcoupons as $salcoupon) {
            // 循环取出一个未使用的此id的优惠券
            $couponget = $this->getSaloncoupongetMapper()->getSaloncouponget5($id, $cusid, $salcoupon->getSciid());
            array_push($coupongetarray, $couponget);
        }
        // 此用户拥有的，未使用的优惠券
        // $customercoupons=$this->getSaloncoupongetMapper()->getSaloncouponget4($id,$cusid);
        
        // treatment表单
        $form = new TreatmentForm();
        return array(
            'id' => $id,
            'cusid' => $cusid,
            'coupongetarray' => $coupongetarray,
            'form' => $form
        )
        ;
    }
    
    // TODO 订单提交页支付
    public function paymentAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        $cusname = $container->cusname; 
        
        // 存入订单
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $entity = new TreatmentEntity();
            $entity->setSalnumber($id);
            $orderid=$id.$cusid.$_POST['prodid'].date('YmdHis');
            $entity->setOrderid($orderid);
            $entity->setCusid($cusid);
            $entity->setCusname($cusname);
            $entity->setProdid($_POST['prodid']);
            $entity->setProdtitle($_POST['prodtitle']);
            $entity->setProductcombinationid($_POST['productcombinationid']);
            $entity->setProductcombinationname($_POST['productcombinationname']);
            $entity->setProductcombinationpicture($_POST['productcombinationpicture']);
            //测试，设为已支付
            $entity->setTrestate("nonpayment");
            $entity->setTreprice($_POST['treprice']);
            $entity->setTreremark($_POST['treremark']);
            $entity->setProductquantity($_POST['productquantity']);
            $entity->setCouponidused($_POST['couponidused']);
            $this->getTreatmentMapper()->saveTreatment($entity);
            //优惠券已使用
            if ($_POST['couponidused']){
            $couponused=$this->getSaloncoupongetMapper()->getSaloncoupongetused($_POST['couponidused']);
            $couponused->setScgstate("used");
            $this->getSaloncoupongetMapper()->saveSaloncouponget($couponused);}
        }
        
        return array(
            'id' => $id,
            'cusid' => $cusid,
            'orderid'=>$orderid,
            'treprice'=>$_POST['treprice']
        );
    }
    //TODO 支付宝验签
    public function alipaycheckoutAction(){
        if(!empty($_POST)){
          $treatment = $this->getTreatmentMapper()->getTreatmentcheckout($_POST['out_trade_no'],$_POST['total_amount']);
          return array(
            'treatment'=>$treatment
          );
        }
        
    }
    // TODO 订单查看页支付
    public function trepaymentAction()
    {       
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
    
        //获取订单
        $treatment=$this->getTreatmentMapper()->getTreatment1($_POST['treid']);
        
    
        return array(
            'id' => $id,
            'cusid' => $cusid,
            'treatment'=>$treatment
        );
    }
    // TODO 类别
    public function classifyAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        
        // 获取此美容院所有分类
        $demandclassifyseriess = $this->getDemandclassifyseriesMapper()->getDemandclassifyseries2($id);
        
        return array(
            'id'=>$id,
            'demandclassifyseriess' => $demandclassifyseriess
        );
    }
    
    // TODO feedbacks
    public function feedbacksAction()
    {
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        
        $treid= $container->treid;
        $cosid=$container->cosid;
        
        $form = new FeedbacksForm();
        $task = new FeedbacksEntity();
        
        $form->bind($task);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = $request->getPost()->toArray();
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $treid=$this->params("sub");
                $cosid=$this->params("third");
                //顾客，美容师，分院，订单（疗程）；
                $customer=$this->getCustomerMapper()->getCustomer1($cusid);
                $cosmetologist=$this->getCosmetologistMapper()->getCosmetologist1($cosid);
                $salonbranch=$this->getSalonMapper()->getSalonpicute($id,$cosmetologist->getSalbranch());
                $treatment = $this->getTreatmentMapper()->getTreatment1($treid);
                
                $prodid=$treatment->getProdid();
                $prodtitle=$treatment->getProdtitle();
                $productcombinationid=$treatment->getProductcombinationid();
                $productcombinationname=$treatment->getProductcombinationname();
                $productcombinationpicture=$treatment->getProductcombinationpicture();
                $cosname=$cosmetologist->getCosname();
                $cosphoto=$cosmetologist->getCosphoto();
                $cusname=$customer->getCusname();
                $cusphoto=$customer->getCusphoto();
                $salname=$salonbranch->getSalname();
                $salphoto1=$salonbranch->getSalphoto1();
                
                $task->setProdid($prodid);
                $task->setProdtitle($prodtitle);
                $task->setProductcombinationid($productcombinationid);
                $task->setProductcombinationname($productcombinationname);
                $task->setProductcombinationpicture($productcombinationpicture);
                $task->setCosname($cosname);
                $task->setCosphoto($cosphoto);
                $task->setCusname($cusname);
                $task->setCusphoto($cusphoto);
                $task->setSalname($salname);
                $task->setSalphoto1($salphoto1);
                
                $task->setSalnumber($id);
                $task->setCusid($cusid);
                $this->getFeedbacksMapper()->saveTask($task);
                
                //保存美容师最近评星
                $this->getCosmetologistMapper()->saveRecentstar($cosid,$post['fbcosmetologist']);
                // Redirect to list of tasks
                
                //压缩评价图
                if (! file_exists('public/fbpicture')) {
                    mkdir('public/fbpicture');
                }
                //图片缩放
                $pname1 = iconv('utf-8', 'gbk', $x['fbpicture1']);//文件名
                $pname11=iconv('utf-8', 'gbk', 'public/fbpicture/');//文件路径
                $pname12=iconv('utf-8', 'gbk', $y['fbpicture1f']['tmp_name']);//临时文件名
                $pname2 = iconv('utf-8', 'gbk', $x['fbpicture2']);//文件名
                $pname21=iconv('utf-8', 'gbk', 'public/fbpicture/');//文件路径
                $pname22=iconv('utf-8', 'gbk', $y['fbpicture2f']['tmp_name']);//临时文件名
                $pname3 = iconv('utf-8', 'gbk', $x['fbpicture3']);//文件名
                $pname31=iconv('utf-8', 'gbk', 'public/fbpicture/');//文件路径
                $pname32=iconv('utf-8', 'gbk', $y['fbpicture3f']['tmp_name']);//临时文件名
                //move_uploaded_file($y['cusphotof']['tmp_name'], 'public/portrait/' . $x['cusphoto']);
                //缩放
                $temp1 = explode(".", $pname1);
                $extension1 = end($temp1);
                $temp2 = explode(".", $pname2);
                $extension2 = end($temp2);
                $temp3 = explode(".", $pname3);
                $extension3 = end($temp3);
                
                //图片1 视频文件直接保存,图片按后缀缩放
                if ($extension1=="mp4"){
                    move_uploaded_file($pname12, $pname11.$pname1);
                }elseif($extension1=="jpg"||$extension1=="jpeg"||$extension1=="gif"||$extension1=="png"){
                    $filename=$pname12;
                    list($width, $height)=getimagesize($filename);
                    if ($width>500||$height>500){//长或宽大于500则缩放
                        //缩放比例
                        $per=round(100/$width,3);
                        
                        $n_w=$width*$per;
                        $n_h=$height*$per;
                        $new=imagecreatetruecolor($n_w, $n_h);
                        
                        switch ($extension1){
                            case "jpg":
                                $img=imagecreatefromjpeg($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagejpeg($new, $pname11.$pname1);
                                break;
                            case "jpeg":
                                $img=imagecreatefromjpeg($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagejpeg($new, $pname11.$pname1);
                                break;
                            case "gif":
                                $img=imagecreatefromgif($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagegif($new, $pname11.$pname1);
                                break;
                            case "png":
                                $img=imagecreatefrompng($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagepng($new, $pname11.$pname1);
                                break;
                        }
                        imagedestroy($new);
                        imagedestroy($img);
                        
                    }else{
                        move_uploaded_file($pname12, $pname11.$pname1);
                    }
                }
                
                //图片2 视频文件直接保存,图片按后缀缩放
                if ($extension2=="mp4"){
                    move_uploaded_file($pname22, $pname21.$pname2);
                }elseif($extension2=="jpg"||$extension2=="jpeg"||$extension2=="gif"||$extension2=="png"){
                    $filename=$pname22;
                    list($width, $height)=getimagesize($filename);
                    if ($width>500||$height>500){//长或宽大于500则缩放
                        //缩放比例
                        $per=round(100/$width,3);
                        
                        $n_w=$width*$per;
                        $n_h=$height*$per;
                        $new=imagecreatetruecolor($n_w, $n_h);
                        
                        switch ($extension2){
                            case "jpg":
                                $img=imagecreatefromjpeg($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagejpeg($new, $pname21.$pname2);
                                break;
                            case "jpeg":
                                $img=imagecreatefromjpeg($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagejpeg($new, $pname21.$pname2);
                                break;
                            case "gif":
                                $img=imagecreatefromgif($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagegif($new, $pname21.$pname2);
                                break;
                            case "png":
                                $img=imagecreatefrompng($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagepng($new, $pname21.$pname2);
                                break;
                        }
                        imagedestroy($new);
                        imagedestroy($img);
                        
                    }else{
                        move_uploaded_file($pname22, $pname21.$pname2);
                    }
                }
                
                //图片1 视频文件直接保存,图片按后缀缩放
                if ($extension3=="mp4"){
                    move_uploaded_file($pname32, $pname31.$pname3);
                }elseif($extension3=="jpg"||$extension3=="jpeg"||$extension3=="gif"||$extension3=="png"){
                    $filename=$pname32;
                    list($width, $height)=getimagesize($filename);
                    if ($width>500||$height>500){//长或宽大于500则缩放
                        //缩放比例
                        $per=round(100/$width,3);
                        
                        $n_w=$width*$per;
                        $n_h=$height*$per;
                        $new=imagecreatetruecolor($n_w, $n_h);
                        
                        switch ($extension3){
                            case "jpg":
                                $img=imagecreatefromjpeg($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagejpeg($new, $pname31.$pname3);
                                break;
                            case "jpeg":
                                $img=imagecreatefromjpeg($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagejpeg($new, $pname31.$pname3);
                                break;
                            case "gif":
                                $img=imagecreatefromgif($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagegif($new, $pname31.$pname3);
                                break;
                            case "png":
                                $img=imagecreatefrompng($filename);
                                //copy部分图像并调整
                                imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);
                                //图像输出新图片、另存为
                                imagepng($new, $pname31.$pname3);
                                break;
                        }
                        imagedestroy($new);
                        imagedestroy($img);
                        
                    }else{
                        move_uploaded_file($pname32, $pname31.$pname3);
                    }
                }
                
                 return $this->redirect()->toRoute('customer', array(
                    'action' => 'me'
                ));
            }
        }else{
            $homepage = $homepage = $this->getPageMapper()->getHomepage($id); // 美容院标识
            // 根据get获取订单,产品类别和美容师信息
            $treatment = $this->getTreatmentMapper()->getTreatment1($treid);
            
            $cosmetologist = $this->getCosmetologistMapper()->getCosmetologist1($cosid);
            
            //根据美容院号和分院号获取分院图片
            $salonbranch=$this->getSalonMapper()->getSalonpicute($id,$cosmetologist->getSalbranch());
        }
        return array(
            'id'=>$id,
            'treatment' => $treatment,
            'cosmetologist' => $cosmetologist,
            'form' => $form,
            'homepage'=>$homepage,
            'salonbranch'=>$salonbranch,
            'treid'=>$treid,
            'cosid'=>$cosid
        );
    }
    
    //TODO treatment
    public function treatmentAction(){
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        
    }
    
    //TODO notificationxml
    public function notificationxmlAction(){
        $sub = $this->params('sub'); // 美容院id
        
        $notification=$this->getNotificationinfoMapper()->getTask2($sub);
        return array('notification'=>$notification);
       
    
    }
    //TODO notificationjson
    public function notificationjsonAction(){
        $sub = $this->params('sub'); // 美容院id
        
        $notifications=$this->getNotificationinfoMapper()->getAllnotificationtoday($sub);
        return array('notifications'=>$notifications);
    }
    //TODO unreadjson
    public function unreadjsoncustomerAction(){
        $sub = $this->params('sub'); // 顾客id
    
        //获取顾客未读信息
        $unreads=$this->getUnreadMapper()->getUnreadmessage("cus".$sub);
        return array('unreads'=>$unreads);
    }
    //TODO iosunread
    public function iosunreadAction(){
        $sub = $this->params('sub'); // 美容院id
    
        $notifications=$this->getNotificationinfoMapper()->getAllnotificationtoday($sub);
        return array('notifications'=>$notifications);
    }
    
    //TODO signup
    public function signupAction(){
        $container = new Container('customerlogin');
        $id = $container->salnumber;
        $cusid = $container->cusid;
        
        $customer=$this->getCustomerMapper()->getCustomer1($cusid);
        
        
        $entity=new SignupEntity();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            //添加
           if (!$this->getSignupMapper()->getTask1($cusid,$post['pageid'])){
            $entity->setSalnumber($id);
            $entity->setPageid($post['pageid']);
            $entity->setPagename($post['pagename']);
            $entity->setPageexpiration($_POST['pageexpiration']);
            $entity->setPageheaddata1($_POST['pageheaddata1']);
            $entity->setPageheaddata2($_POST['pageheaddata2']);
            $entity->setCusid($cusid);
            $entity->setCusname($customer->getCusname());
            $entity->setCusphone($customer->getCusphone());
            $entity->setCusphoto($customer->getCusphoto());
            $this->getSignupMapper()->saveTask($entity);    
           }else {
               $this->getSignupMapper()->deleteTask1($cusid,$post['pageid']);
           }
        }
    }
}
