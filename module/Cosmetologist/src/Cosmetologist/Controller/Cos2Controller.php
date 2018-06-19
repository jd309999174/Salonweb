<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Cosmetologist for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Cosmetologist\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Cosmetic\Cosmetologist\CosmetologistForm;
use Cosmetic\Cosmetologist\CosmetologistEntity;
use Zend\Authentication\AuthenticationService;
use Zend\Session\Container;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Cosmetic\Chatmodule\ChatmoduleEntity;
use Cosmetic\Chatmodule\ChatmoduleForm;
use Cosmetic\Unread\UnreadEntity;
date_default_timezone_set('Asia/Shanghai');//时区
class Cos2Controller extends AbstractActionController
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
    public function getAccountMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('AccountMapper');
    }
    public function getTipMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('TipMapper');
    }
    public function getFeedbacksMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('FeedbacksMapper');
    }
    public function getUnreadMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('UnreadMapper');
    }
    public function getTrolleyMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('TrolleyMapper');
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
    
    public function indexAction()
    {
        
        
        return array();
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /cos2/cos2/foo
        return array();
    }
    
    //TODO login
    public function loginAction()
    {
        $sub = $this->params('sub');
        
        $homepage=$homepage=$this->getPageMapper()->getHomepage($sub);//美容院标识
        $form = new CosmetologistForm();
        $customer = new CosmetologistEntity();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $cosmetologist=$this->getCosmetologistMapper()->getCosmetologistlogin($post['cosphone'],$post['cospassword']);
            if ($cosmetologist) {
                 
            
                // 设置session
                $container = new Container('cosmetologistlogin');
                $container->salnumber = $cosmetologist->getSalnumber();
                $container->cosid = $cosmetologist->getCosid();
                $container->cosname = $cosmetologist->getCosname();
                $container->cosphone = $cosmetologist->getCosphone();
            
                return $this->redirect()->toRoute('cosmetologist', array(
                    'action' => 'customerlist',
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
        }
        
        return array(
            'form'=>$form,
            'sub'=>$sub,
            'homepage'=>$homepage,
        );
    }
    
    //customerlist
    public function customerlistAction()
    {
        $sub = $this->params('sub'); // 美容院id
        $third=$this->params('third');//判断是否是登录页的跳转
        
        if($third=="login"){
            //取出session
            $container = new Container('cosmetologistlogin');
            $id = $container->salnumber;
            $cosid = $container->cosid;
            $cosname = $container->cosname;
            $cosphone = $container->cosphone;
            // 设置cookie
            $expire=time()+60*60*24*30;
            setcookie("salnumber", $id, $expire);
            setcookie("cosid", $cosid, $expire);
            setcookie("cosname", $cosname, $expire);
            setcookie("cosphone", $cosphone, $expire);
        }else{
            //按cookie设session
                    $container = new Container('cosmetologistlogin');
                    $container->salnumber = $_COOKIE['salnumber'];
                    $container->cosid = $_COOKIE['cosid'];
                    $container->cosname = $_COOKIE['cosname'];
                    $container->cosphone = $_COOKIE['cosphone'];
                    
                    $id = $container->salnumber;
                    $cosid = $container->cosid;
                    $cosname = $container->cosname;
                    $cosphone = $container->cosphone;
                    
        }
        if(!$cosid){
            return $this->redirect()->toRoute('cosmetologist', array(
                'action' => 'login',
                'sub' => $sub
            ));
        }
        
        
        
        
        
        //显示客户列表，带搜索，然后跳转此客户已支付的订单
       //$container = new Container('cosmetologistlogin');
        //$id = $container->salnumber;
    
        $customers=$this->getCustomerMapper()->getCustomer($id);
    
        
        //未读信息
        $unread=$this->getUnreadMapper()->getTask1("cos".$cosid);
        $unreadsum=0;
        foreach ($unread as $unreadone){
            $unreadsum=$unreadsum+$unreadone->getNumber();
        }
        
        $homepage = $homepage = $this->getPageMapper()->getHomepage($sub); // 美容院标识
        
        //取出美容院,判断是否审核中
        $account=$this->getAccountMapper()->getAccount($id);
        
        return array(
            'account'=>$account,
            'cosid'=>$cosid,
            'customers'=>$customers,
            'id'=>$sub,
            'unreadsum'=>$unreadsum,
            'homepage'=>$homepage
        );
    }
    
    //订单
    public function treatmentAction()
    {
        $sub = $this->params('sub'); // 用户id
        //显示此客户的所有已支付的订单
        $container = new Container('cosmetologistlogin');
        $id = $container->salnumber;
        $cosid = $container->cosid;
        
        $customer = $this->getCustomerMapper()->getCustomer1($sub);
        
        $sub = $this->params('sub');//客户id
        
        $treatments=$this->getTreatmentMapper()->getTreatment3($sub);
        
        return array(
            'customer'=>$customer,
            'id'=>$id,
            'treatments'=>$treatments,
            'cosid'=>$cosid
        );
    }
    
    //服务过的疗程
    public function servedAction()
    {
        //
        $container = new Container('cosmetologistlogin');
        $id = $container->salnumber;
        $cosid = $container->cosid;
    
        //按美容师id列出疗程
        $services=$this->getFeedbacksMapper()->getTask1($cosid);
        return array(
            'id'=>$id,
            'cosid'=>$cosid,
            'services'=>$services
        );
    }
    
    //预约
    public function appointmentcosAction()
    {
        //显示此美容师的所有预约
        $container = new Container('cosmetologistlogin');
        $id = $container->salnumber;
        $cosid = $container->cosid;
    
        $appointmentcos=$this->getAppointmentMapper()->getAppointmentcos2($cosid);
        
        //未读信息
        $unread=$this->getUnreadMapper()->getTask1("cos".$cosid);
        $unreadsum=0;
        foreach ($unread as $unreadone){
            $unreadsum=$unreadsum+$unreadone->getNumber();
        }
        
        $homepage = $homepage = $this->getPageMapper()->getHomepage($id); // 美容院标识
        
        return array(
            'id'=>$id,
            'cosid'=>$cosid,
            'appointmentcos'=>$appointmentcos,
            'unreadsum'=>$unreadsum,
            'homepage'=>$homepage
        );
    }
    
    //聊天的顾客列表
    public function customerlistchatAction()
    {
        //显示客户列表，带搜索，然后聊天
        $container = new Container('cosmetologistlogin');
        $id = $container->salnumber;
        $cosid = $container->cosid;
        
        $customers=$this->getCustomerMapper()->getCustomer($id);
        //获取此美容师为接收方的所有未读            发送方为某美容师，则显示未读数  每个未读只能循环一次，所有分别取
        $receiveunread=$this->getUnreadMapper()->getTask1('cos'.$cosid);
        //未读信息
        $unread=$this->getUnreadMapper()->getTask1("cos".$cosid);
        $unreadsum=0;
        foreach ($unread as $unreadone){
            $unreadsum=$unreadsum+$unreadone->getNumber();
        }
        $homepage = $homepage = $this->getPageMapper()->getHomepage($id); // 美容院标识
        return array(
            'id'=>$id,
            'customers'=>$customers,
            'unreadsum'=>$unreadsum,
            'receiveunread'=>$receiveunread,
            'homepage'=>$homepage
        );
    }
    //聊天的顾客列表
    public function customerlistchatcheckAction()
    {
        //显示客户列表，带搜索，然后聊天
        $container = new Container('cosmetologistlogin');
        $id = $container->salnumber;
        $cosid = $container->cosid;
        
        $customers=$this->getCustomerMapper()->getCustomer($id);
        //获取此美容师为接收方的所有未读            发送方为某美容师，则显示未读数  每个未读只能循环一次，所有分别取
        $receiveunread=$this->getUnreadMapper()->getTask1('cos'.$cosid);
        //未读信息
        $unread=$this->getUnreadMapper()->getTask1("cos".$cosid);
        $unreadsum=0;
        foreach ($unread as $unreadone){
            $unreadsum=$unreadsum+$unreadone->getNumber();
        }
        $homepage = $homepage = $this->getPageMapper()->getHomepage($id); // 美容院标识
        return array(
            'id'=>$id,
            'customers'=>$customers,
            'unreadsum'=>$unreadsum,
            'receiveunread'=>$receiveunread,
            'homepage'=>$homepage
        );
    }
    
    // TODO 聊天
    public function chatAction()
    {
        $container = new Container('cosmetologistlogin');
        $id = $container->salnumber;
        $cosid = $container->cosid;
        $sub = $this->params('sub');//顾客id
        $third = $this->params('third');//判断是否是ios审核页
         // 自己和顾客
        $cosmetologist = $this->getCosmetologistMapper()->getCosmetologist1($cosid);
        $customer = $this->getCustomerMapper()->getCustomer1($sub);
        //判断我给对方的未读条目是否存在，不存在则新建
        if(!$this->getUnreadMapper()->getTask('cos'.$cosid,'cus'.$customer->getCusid())){
            //新建未读
            $unreadentity=new UnreadEntity();
            $unreadentity->setSendid('cos'.$cosid);
            $unreadentity->setReceiveid('cus'.$customer->getCusid());
            $this->getUnreadMapper()->saveTask($unreadentity);
        }
        //判断对方给我的未读条目是否存在，不存在则新建
        if(!$this->getUnreadMapper()->getTask('cus'.$customer->getCusid(),'cos'.$cosid)){
            //新建未读
            $unreadentity=new UnreadEntity();
            $unreadentity->setSendid('cus'.$customer->getCusid());
            $unreadentity->setReceiveid('cos'.$cosid);
            $this->getUnreadMapper()->saveTask($unreadentity);
        }
        
    //加载最近的20条
        $chatmodule = $this->getChatmoduleMapper()->fetchAllbegin('cus' . $sub, 'cos' . $cosid);
        //未读清零
        //对方给自己的未读条目数，每次刷新要清0
        $receiveunread=$this->getUnreadMapper()->getTask('cus'.$customer->getCusid(),'cos'.$cosmetologist->getCosid());
        $receiveunread->setNumber(0);
        $this->getUnreadMapper()->saveTask($receiveunread);
        
        
        $form = new ChatmoduleForm();
        
        return array(
            'id'=>$id,
            'third'=>$third,
            'form' => $form,
            'cosid'=>$cosid,
            'customer' => $customer,
            'sub'=>$sub,
            'unread'=>$customer->getUnread(),
            'chatmodule'=>$chatmodule,
            'cosmetologist'=>$cosmetologist
        );
    }
    
    public function chatajaxAction()
    {
        $container = new Container('cosmetologistlogin');
        $id = $container->salnumber;
        $cosid = $container->cosid;
        $cosname=$container->cosname;
        $sub = $this->params('sub');
    
        
        // 自己和顾客
        $cosmetologist = $this->getCosmetologistMapper()->getCosmetologist1($cosid);
        $customer = $this->getCustomerMapper()->getCustomer1($sub);
        //给对方的信息,每发送一次要加1
        $sendunread=$this->getUnreadMapper()->getTask('cos'.$cosmetologist->getCosid(),'cus'.$customer->getCusid());
        //对方给自己的未读条目数，每次刷新要清0
        $receiveunread=$this->getUnreadMapper()->getTask('cus'.$customer->getCusid(),'cos'.$cosmetologist->getCosid());
        
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
                $entity->setReceiveid('cus' .$customer->getCusid());
                $entity->setSendid('cos' . $cosid);
    
                $this->getChatmoduleMapper()->saveChat($entity);
     
              
                //给对方添加一条未读,并输入自己现在的名字，防止改名后未读信息不改名,
                $sendunread->setNumber($sendunread->getNumber()+1);//未读
                $sendunread->setSendname($cosname);//发送者名
                $sendunread->setLastword("[图片]");//最后的话
                $this->getUnreadMapper()->saveTask($sendunread);
                
                
                // 获取一条聊天记录
                $chatmodule = $this->getChatmoduleMapper()->fetchAllone('cus' .$customer->getCusid(), 'cos' . $cosid);
            } else
            if($_POST['chatword']!==""&&$_POST['chatword']!=="[refresh]"){
                $entity->setReceiveid('cus' . $customer->getCusid());
                $entity->setSendid('cos' . $cosid);
                $entity->setChatword($_POST['chatword']);
    
                $this->getChatmoduleMapper()->saveChat($entity);
            
                //给对方添加一条未读,并输入自己现在的名字，防止改名后未读信息不改名,
                $sendunread->setNumber($sendunread->getNumber()+1);//未读
                $sendunread->setSendname($cosname);//发送者名
                $sendunread->setLastword($_POST['chatword']);//最后的话
                $this->getUnreadMapper()->saveTask($sendunread);
                // 获取一条聊天记录
                $chatmodule = $this->getChatmoduleMapper()->fetchAllone('cus' . $customer->getCusid(), 'cos' . $cosid);
                
            }
            if($_POST['chatword']=="[refresh]"){
                // 获取对方给自己的未读信息
                if($receiveunread->getNumber()+0>0){//无内容刷新时，$chatmodule为空
                $chatmodule = $this->getChatmoduleMapper()->fetchAllunread('cus'.$customer->getCusid(), 'cos'.$cosid,$receiveunread->getNumber()+0);  
                $receiveunread->setNumber(0);
                $this->getUnreadMapper()->saveTask($receiveunread);
                }
               }
        }
        
        return array(
            'id'=>$id,
            'sendunread'=>$sendunread,
            'chatmodule' => $chatmodule,
            'cosid' => $cosid,
            'sub' => $sub,
            'cosmetologist' => $cosmetologist,
            'customer' => $customer,
            'receiveunread'=>$receiveunread,
            'request'=>$request
        );
    }
    //聊天历史
    public function chathistoryAction(){
        $container = new Container('cosmetologistlogin');
        $id = $container->salnumber;
        $cosid = $container->cosid;
        $sub = $this->params('sub');//顾客id
        // 自己和顾客
        $cosmetologist = $this->getCosmetologistMapper()->getCosmetologist1($cosid);
        $customer = $this->getCustomerMapper()->getCustomer1($sub);
        
        if ($_GET['searching']==null){
        $chatmodule = $this->getChatmoduleMapper()->fetchAlldate('cus' . $sub, 'cos' . $cosid,date("Ymd"));
        }else {
            $searchingstamp=strtotime($_GET['searching']);
            $searchingdate=date("Ymd",$searchingstamp);
        $chatmodule = $this->getChatmoduleMapper()->fetchAlldate('cus' . $sub, 'cos' . $cosid,$searchingdate);
        }
       
        return array(
            'cosid'=>$cosid,
            'customer' => $customer,
            'sub'=>$sub,
            'unread'=>$customer->getUnread(),
            'chatmodule'=>$chatmodule,
            'cosmetologist'=>$cosmetologist
        );
    }
    //我
    public function meAction()
    {
        //
        $container = new Container('cosmetologistlogin');
        $id = $container->salnumber;
        $cosid = $container->cosid;
        
        $homepage=$homepage=$this->getPageMapper()->getHomepage($id);//美容院标识
        
        $cosmetologist=$this->getCosmetologistMapper()->getCosmetologist1($cosid);//美容师头像
        
        //$feedbacks=$this->getFeedbacksMapper()->getTask11($cosid);//对美容师的评星
        //未读信息
        $unread=$this->getUnreadMapper()->getTask1("cos".$cosid);
        $unreadsum=0;
        foreach ($unread as $unreadone){
            $unreadsum=$unreadsum+$unreadone->getNumber();
        }
        return array(
            'id'=>$id,
            'cosid'=>$cosid,
            'unreadsum'=>$unreadsum,
            'cosmetologist'=>$cosmetologist,
            'homepage'=>$homepage
            //'feedbacks'=>$feedbacks
        );
    }
    //TODO unreadjson
    public function unreadjsoncosmetologistAction(){
        $sub = $this->params('sub'); // 美容师id
    
        //获取顾客未读信息
        $unreads=$this->getUnreadMapper()->getUnreadmessage("cos".$sub);
        return array('unreads'=>$unreads);
    }
    
    
    // TODO myfeedbacks
    public function myfeedbacksAction()
    {
        $container = new Container('cosmetologistlogin');
        $id = $container->salnumber;
        $cosid = $container->cosid;
        
        $feedbacks=$this->getFeedbacksMapper()->getTask11($cosid);//对美容师的评星
        
        return array(
            'feedbacks'=>$feedbacks
        );
    }
    
    
    // TODO mytiplist
    public function mytiplistAction()
    {
        $container = new Container('cosmetologistlogin');
        $id = $container->salnumber;
        $cosid = $container->cosid;
        
        $cosmetologist=$this->getCosmetologistMapper()->getCosmetologist1($cosid);//美容师头像
        $tiplist=$this->getTipMapper()->getTask2($cosid);
        
        return array(
            'cosmetologist'=>$cosmetologist,
            'tiplist'=>$tiplist
        );
    }
    
    
}
