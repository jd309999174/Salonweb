<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Salonboss for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Salonboss\Controller;
use Zend\Session\Container;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Cosmetic\Account\AccountEntity;
use Cosmetic\Account\AccountForm;
use Cosmetic\Page\PageEntity;
use Decorate\Template\TemplateEntity;
date_default_timezone_set('Asia/Shanghai');//时区
class SalonbossController extends AbstractActionController
{
    // 生成随机账号
    public function newaccount($length)
    {
        $chars = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
        $hash = '';
        $max = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i ++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        
        return $hash;
    }
    public function getTemplateMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('TemplateMapper');
    }
    public function getSignupMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('SignupMapper');
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
    public function getAccountMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('AccountMapper');
    }
    public function getPageMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('PageMapper');
    }
    public function getTreatmentMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('TreatmentMapper');
    }
    
    //TODO register
    public function salonbossregisterAction()
        {
            $recommend = $this->params('sub');//推荐的美容院编号
            
            //直接用的顾客短信验证部分
            $container = new Container('customerregister');
            $cusverification = $container->cusverification;
            $cusregisterphone = $container->cusregisterphone;
        
            $form = new AccountForm();
            $account = new AccountEntity();
            $form->bind($account);
        
            $request = $this->getRequest();
            if ($request->isPost()) {
              if ($cusverification){
                  if ($_POST['registerverification']==$cusverification&&$_POST['salbossphone']==$cusregisterphone){
                $x = $request->getPost()->toArray();
                $y = $request->getFiles()->toArray();
                $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
                
                //生成账号 判断账号是否已存在
                $newaccount = $this->newaccount(10);
                $existaccount=$this->getAccountMapper()->getAccountexist($newaccount);
                while ($existaccount){
                    $newaccount = newaccount(10);
                    $existaccount=$this->getAccountMapper()->getAccountexist($newaccount);
                }
                
                //判断手机号是否已存在
                $existsalbossphone=$this->getAccountMapper()->getSalbossphoneexist($post['salbossphone']);
                if ($existsalbossphone){
                    return array(
                        'form' => $form,
                        'existsalbossphone'=>$existsalbossphone
                    );
                }
                $form->setData($post);
               
                if ($form->isValid()) {
                    $data = $form->getData();
                    $account->setSalaccount($newaccount);
                    if (!$post['salname']){$account->setSalname('美容');}
                    if (!$post['salbossphoto']){$account->setSalbossphoto('salonbosslogo.png');}
                    $this->getAccountMapper()->saveAccount($account);
                    //修改salnumber
                    $existsal=$this->getAccountMapper()->getSalbossphoneexist($post['salbossphone']);
                    $existsal->setSalnumber($existsal->getAccountid());
                    $this->getAccountMapper()->saveAccount($existsal);
                    if (! file_exists('public/salbossphoto')) {
                        mkdir('public/salbossphoto');
                    }
                    if (! file_exists('public/salon/'.$post['salnumber'])) {
                        mkdir('public/salon/'.$post['salnumber']);
                    }
                    if ($x['salbossphoto']){
                    //图片缩放
                    $pname = iconv('utf-8', 'gbk', $x['salbossphoto']);//文件名
                    $pname1=iconv('utf-8', 'gbk', 'public/salbossphoto/');//文件路径
                    $pname2=iconv('utf-8', 'gbk', $y['salbossphotof']['tmp_name']);//临时文件名
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
                    }}
                }
                
        
                $regaccount=$this->getAccountMapper()->getAccountlogin($post['salbossphone'],$post['salpassword']);
                
                $page = new PageEntity();
                $page->setPagetype("首页");
                $page->setSalnumber($regaccount->getSalnumber());
                $page->setPagename("首页");
                $page->setPageheaddata3("/img/defaultbanner.jpg");//默认店招
                $page->setPagecolor("white");//默认颜色
                //默认首页标识使用salbossphoto,名称使用salname
                if ($x['salbossphoto']){
                $salbossphoto = '/salbossphoto/'.$x['salbossphoto'];
                $page->setPageheaddata1($salbossphoto);
                }
                if ($post['salname']){
                    $page->setPageheaddata2($post['salname']);
                }
                $this->getPageMapper()->savePage($page);
                if (! file_exists('public/salon/'.$post['salnumber'])) {
                    mkdir('public/salon/'.$post['salnumber']);
                }
                
                //首页默认模块
                $homepage=$this->getPageMapper()->getHomepage($regaccount->getSalnumber());
                $homepagetemplate1=new TemplateEntity();
                $homepagetemplate1->setPageid($homepage->getPageid());
                $homepagetemplate1->setSalnumber($regaccount->getSalnumber());
                $homepagetemplate1->setTemplateindex(0);
                $homepagetemplate1->setTemplatetype("singlerow");
                $homepagetemplate1->setTemplatedata2("/img/defaulthomepage1.jpg");
                $this->getTemplateMapper()->saveTemplate($homepagetemplate1);
                
                $homepagetemplate2=new TemplateEntity();
                $homepagetemplate2->setPageid($homepage->getPageid());
                $homepagetemplate2->setSalnumber($regaccount->getSalnumber());
                $homepagetemplate2->setTemplateindex(1);
                $homepagetemplate2->setTemplatetype("singlerow");
                $homepagetemplate2->setTemplatedata2("/img/defaulthomepage2.jpg");
                $this->getTemplateMapper()->saveTemplate($homepagetemplate2);
                
                //默认活动页
                $pageactivity = new PageEntity();
                $pageactivity->setPagetype("活动");
                $pageactivity->setSalnumber($regaccount->getSalnumber());
                $pageactivity->setPagename("五一大酬宾");
                $pageactivity->setPagecondition("显示");
                $pageactivity->setModificationtime("2018-05-01 00:00:00");
                $pageactivity->setPageheaddata1("/img/51.png");
                $pageactivity->setPageheaddata2("/salon/test.mp4");
                $pageactivity->setPageheaddata3("[活动]感恩新老顾客，魅力五一");
                $pageactivity->setPageexpiration("2018-05-1");
                $this->getPageMapper()->savePage($pageactivity);
                
                
                //推荐美容院的保存
                if ($recommend){
                $account=$this->getAccountMapper()->getAccount($recommend);
                $account->setRecommendnum($account->getRecommendnum()+1);
                $account->setRecommendsal($account->getRecommendsal().",".$regaccount->getSalnumber().",");
                $this->getAccountMapper()->saveAccount($account);
                }
                // Redirect to list of tasks
                
                $container = new Container('salonbosslogin');
                $container->salnumber = $regaccount->getSalnumber();
                $container->salaccount = $regaccount->getSalaccount();
                return $this->redirect()->toRoute('salonboss', array(
                    'action' => 'cusorder','sub'=>'register'
                ));
               }else{
                   return array(
                       'form' => $form,
                       'verificationwrong'=>"验证码错误",
                       'recommend'=>$recommend
                   );
               }}else{
                   return array(
                       'form' => $form,
                       'verificationwrong'=>"验证码错误",
                       'recommend'=>$recommend
                   );
               };
            }
            
            return array(
                'form' => $form,
                'recommend'=>$recommend
            );
    }
    public function registerokAction(){
        $sub = $this->params('sub'); // 账号
        $third = $this->params('third');//密码
        return array('sub'=>$sub,'third'=>$third);
    }
    public function salonagreementAction(){
        
        return array();
    }
// TODO login
    public function salonbossloginAction()
    {
        
        $form = new AccountForm();
        $salon = new AccountEntity();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                
                $accountlogin=$this->getAccountMapper()->getAccountlogin($_POST['salbossphone'],$_POST['salpassword']);
                
                if ($accountlogin!=null) {
                    
                    $container = new Container('salonbosslogin');
                    $container->salnumber = $accountlogin->getSalnumber();
                    $container->salaccount = $accountlogin->getSalaccount();
                    
                    return $this->redirect()->toRoute('salonboss', array(
                        'action' => 'cusorder',
                        'sub'=>"login"
                    ));
                } else {
                    return array(
                         'form' => $form,
                         'result'=>"账号或密码错误"
                        );
                }
            }
        }
        return array(
            'form' => $form
        );
    }
    
    //TODO cusorder
    public function cusorderAction()
    {
        $sub = $this->params('sub'); //判断是否是登录页的跳转
       
        
        if($sub=="login"||$sub="register"){
            //取出session
            $container = new Container('salonbosslogin');
            $id = $container->salnumber;
            $salaccount = $container->salaccount;
            // 设置cookie
            $expire=time()+60*60*24*30;
            setcookie("salnumber", $id, $expire);
            setcookie("salaccount", $salaccount, $expire);
        }else{
            //按cookie设session
            $container = new Container('salonbosslogin');
            $container->salnumber = $_COOKIE['salnumber'];
            $container->salaccount = $_COOKIE['salaccount'];
        
            $id = $container->salnumber;
            $salaccount= $container->salaccount;
        
        }
        
        
        if(!$salaccount){
            return $this->redirect()->toRoute('salonboss', array(
                'action' => 'salonbosslogin'
            ));
        }
        
        //取出7天的订单数
        $sevendayscount=$this->getTreatmentMapper()->getSevendayscount($id);
        
        $homepage=$homepage=$this->getPageMapper()->getHomepage($id);//美容院标识
        return array(
            'id'=>$id,
            'homepage'=>$homepage,
            'sevendayscount'=>$sevendayscount
        );
    }
    public function cusorderajaxAction(){
        //取出session
        $container = new Container('salonbosslogin');
        $id = $container->salnumber;
        $salaccount = $container->salaccount;
        
        $nowValue=date("YmdHis",time());
        switch ($_POST['minValue']){
            case "yesterday":
                $minValue=date("Ymd",strtotime('-1 day'))."000000";
                $maxValue=date("Ymd",time())."000000";
                $treatments=$this->getTreatmentMapper()->getTreatmentongmtclose($id,$minValue,$maxValue);
                break;
            case "aweek":
                $minValue=date("Ymd",strtotime('-1 week'))."000000";
                $treatments=$this->getTreatmentMapper()->getTreatmentongmtclose($id,$minValue,$nowValue);
                break;
            case "amonth":
                $minValue=date("Ymd",strtotime('-1 month'))."000000";
                $treatments=$this->getTreatmentMapper()->getTreatmentongmtclose($id,$minValue,$nowValue);
                break;
            case "today":
                $minValue=date("Ymd",time())."000000";
                $treatments=$this->getTreatmentMapper()->getTreatmentongmtclose($id,$minValue,$nowValue);
                break;
        }
        return array('treatments'=>$treatments);
    }
    
    
    //TODO cusreview
    public function cusreviewAction()
    {//取出session
        $container = new Container('salonbosslogin');
        $id = $container->salnumber;
        $salaccount = $container->salaccount;
        
        $homepage=$homepage=$this->getPageMapper()->getHomepage($id);//美容院标识
        
        //取出7天的评价数
        $sevendayscount=$this->getFeedbacksMapper()->getSevendayscount($id);
        return array(
            'id'=>$id,
            'homepage'=>$homepage,
            'sevendayscount'=>$sevendayscount
        );
    }
    public function cusreviewajaxAction(){
        //取出session
        $container = new Container('salonbosslogin');
        $id = $container->salnumber;
        $salaccount = $container->salaccount;
        
        $nowValue=date("YmdHis",time());
        switch ($_POST['minValue']){
            case "yesterday":
                $minValue=date("Ymd",strtotime('-1 day'))."000000";
                $maxValue=date("Ymd",time())."000000";
                $feedbacks=$this->getFeedbacksMapper()->getFeedbacksongmtfbdate($id,$minValue,$maxValue);
                break;
            case "aweek":
                $minValue=date("Ymd",strtotime('-1 week'))."000000";
                $feedbacks=$this->getFeedbacksMapper()->getFeedbacksongmtfbdate($id,$minValue,$nowValue);
                break;
            case "amonth":
                $minValue=date("Ymd",strtotime('-1 month'))."000000";
                $feedbacks=$this->getFeedbacksMapper()->getFeedbacksongmtfbdate($id,$minValue,$nowValue);
                break;
            case "today":
                $minValue=date("Ymd",time())."000000";
                $feedbacks=$this->getFeedbacksMapper()->getFeedbacksongmtfbdate($id,$minValue,$nowValue);
                break;
        }
        return array('feedbacks'=>$feedbacks);
    }
    
    
    //TODO cusbrowsing
    public function cusbrowsingAction(){
        //取出session
        $container = new Container('salonbosslogin');
        $id = $container->salnumber;
        $salaccount = $container->salaccount;
        
        $homepage=$homepage=$this->getPageMapper()->getHomepage($id);//美容院标识
        
        //取出7天的人数
        $sevendayscount=$this->getCusbrowsinghistoryMapper()->getSevendayscount($id);
        return array(
            'id'=>$id,
            'homepage'=>$homepage,
            'sevendayscount'=>$sevendayscount
        );
    }
    public function cusbrowsingajaxAction(){
        //取出session
        $container = new Container('salonbosslogin');
        $id = $container->salnumber;
        $salaccount = $container->salaccount;
        
        $nowValue=date("YmdHis",time());
        switch ($_POST['minValue']){
            case "yesterday":
                $minValue=date("Ymd",strtotime('-1 day'))."000000";
                $maxValue=date("Ymd",time())."000000";
                $cusbrowsings=$this->getCusbrowsinghistoryMapper()->getCusbrowsingongmtcusdate($id,$minValue,$maxValue);
                break;
            case "aweek":
                $minValue=date("Ymd",strtotime('-1 week'))."000000";
                $cusbrowsings=$this->getCusbrowsinghistoryMapper()->getCusbrowsingongmtcusdate($id,$minValue,$nowValue);
                break;
            case "amonth":
                $minValue=date("Ymd",strtotime('-1 month'))."000000";
                $cusbrowsings=$this->getCusbrowsinghistoryMapper()->getCusbrowsingongmtcusdate($id,$minValue,$nowValue);
                break;
            case "today":
                $minValue=date("Ymd",time())."000000";
                $cusbrowsings=$this->getCusbrowsinghistoryMapper()->getCusbrowsingongmtcusdate($id,$minValue,$nowValue);
                break;
        }
        return array('cusbrowsings'=>$cusbrowsings);
    }
    
    
    public function meAction()
    {
        //取出session
        $container = new Container('salonbosslogin');
        $id = $container->salnumber;
        $salaccount = $container->salaccount;
        
        $homepage=$homepage=$this->getPageMapper()->getHomepage($id);//美容院标识
        
        $activitypages = $this->getPageMapper()->getActivitypages($id, "活动");
        
        //判断账号是否已存在
        $existaccount=$this->getAccountMapper()->getAccountexist($salaccount);
        
        return array(
            "id"=>$id,
            "homepage"=>$homepage,
            "existaccount"=>$existaccount,
            'activitypages' => $activitypages
        );
    }
    //TODO 活动参加人数查询
    public function cusactivityAction()
    {
        $sub=$this->params('sub');
        
        //取出session
        $container = new Container('salonbosslogin');
        $id = $container->salnumber;
        $salaccount = $container->salaccount;
        
        $signups=$this->getSignupMapper()->getActivityregister($sub);
        
        return array("signups"=>$signups);
    }
    //TODO 手续费减免
    public function reducechargeAction()
    {

        //取出session
        $container = new Container('salonbosslogin');
        $id = $container->salnumber;
        $salaccount = $container->salaccount;
        
        $account = $this->getAccountMapper()->getAccount($id);
        
        return array("id"=>$id,'account'=>$account);
    }
    public function salbossdetailAction()
    {
        //取出session
        $container = new Container('salonbosslogin');
        $id = $container->salnumber;
        $salaccount = $container->salaccount;
        
        $account = $this->getAccountMapper()->getAccount($id);
        
        return array("id"=>$id,'account'=>$account);
       
    }
    public function resetAction()
    {
        //取出session
        $container = new Container('salonbosslogin');
        $id = $container->salnumber;
        $salaccount = $container->salaccount;
        
        $containerregister = new Container('customerregister');
        $cusverification = $containerregister->cusverification;
        $cusregisterphone = $containerregister->cusregisterphone;
        
        $sub = $this->params('sub'); //需修改的项目 例：cusname
        
        $account = $this->getAccountMapper()->getAccount($id);
        
        $form = new AccountForm();
        //$account = new AccountEntity();
        //$form->bind($account);
        
        $request = $this->getRequest();
        
        if ($request->isPost()){
                
                    $x = $request->getPost()->toArray();
                    $y = $request->getFiles()->toArray();
                    $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
                    
                    if ($request->isPost()) {
                        if ($sub=="salbossphoto"){
                            $account->setSalbossphoto($post['salbossphoto']);
                           
                        }elseif($sub=="salbossname"){
                            $account->setSalbossname($post['salbossname']);
                        }elseif($sub=="salbossphone"){
                            //判断手机号是否已存在
                            $existsalbossphone=$this->getAccountMapper()->getSalbossphoneexist($post['salbossphone']);
                            if ($existsalbossphone){
                                return array(
                                    'form' => $form,
                                    'existsalbossphone'=>$existsalbossphone,
                                    'sub'=>$sub
                                );
                            }
                            if ($_POST['registerverification']!=$cusverification){
                                return array(
                                    'form' => $form,
                                    'verificationwrong'=>"验证码错误",
                                    'recommend'=>$recommend,
                                    'sub'=>$sub
                                );
                            }
                            $account->setSalbossphone($post['salbossphone']);
                        }elseif($sub=="salpassword"){
                            $account->setSalpassword($post['salpassword']);
                        }elseif ($sub=="salbossidentity"){
                            $account->setSalbossidentity($post['salbossidentity']);
                        }
                    
                    
                    $form->setData($post);
                    
                    
                        
                        
                        if (! file_exists('public/salbossphoto')) {
                            mkdir('public/salbossphoto');
                        }
                        if (! file_exists('public/salon/'.$post['salnumber'])) {
                            mkdir('public/salon/'.$post['salnumber']);
                        }
                        if ($x['salbossphoto']){
                            
                            //图片缩放
                            $pname = iconv('utf-8', 'gbk', $x['salbossphoto']);//文件名
                            $pname1=iconv('utf-8', 'gbk', 'public/salbossphoto/');//文件路径
                            $pname2=iconv('utf-8', 'gbk', $y['salbossphotof']['tmp_name']);//临时文件名
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
                            }}
                    }
                
                //保存修改后的
                $this->getAccountMapper()->saveAccount($account);
                // Redirect to list of tasks
                return $this->redirect()->toRoute('salonboss', array(
                    'action' => 'salbossdetail'
                ));
        
        }
                return array("id"=>$id,'form'=>$form,'sub'=>$sub);
        
    }
    public function cusloginAction()
    {
        return array();
    }
    public function indexAction()
    {
        return array();
    }
    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /salonboss/salonboss/foo
        return array();
    }
}
