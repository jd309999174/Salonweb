<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Cosmetic for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Cosmetic\Controller;

use Zend\Session\Container;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
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
use Cosmetic\Page\PageForm;
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
class CosController extends AbstractActionController
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
    //删除目录下所有文件
    function delAllDir($dir)
    {
        
        $dh = opendir($dir);
        closedir(opendir($dir));
        while ( false  !== ( $file  =  readdir ( $dh)))
        {
            if($file != '.' && $file != '..')
            {
                $fullpath = $dir.'/'.$file;
                if(is_dir($fullpath))
                {
                    $this->delAllDir($fullpath);
                }else
                {
                    unlink($fullpath);
                }
                @rmdir($fullpath);
            }
    
        }
        return true;
    }
    
    
    public function getTipMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('TipMapper');
    }
    public function getTemplateMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('TemplateMapper');
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
    public function getPageMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('PageMapper');
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

    public function getCustomerMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('CustomerMapper');
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

    public function getProductMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('ProductMapper');
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
    public function getDemandclassifyseriesMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('DemandclassifyseriesMapper');
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
    
    
    public function personalwebAction()
    {
        return new ViewModel();
    }
    
    public function indexAction()
    {
        $mapper = $this->getSalonMapper();
        return new ViewModel(array(
            'salons' => $mapper->fetchAll()
        ));
    }
    //appqrcode
    public function appqrcodeAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $homepage = $homepage = $this->getPageMapper()->getHomepage($id); // 美容院标识
        
        return new ViewModel(array(
            'id' => $id,
            'homepage'=>$homepage
        ));
    }
    public function appdownloadAction()
    {
        $salonnumber=$this->params('sub');
        $appname=$this->params('third');
        
        $homepage = $homepage = $this->getPageMapper()->getHomepage($salonnumber); // 美容院标识
        $account = $this->getAccountMapper()->getAccount($salonnumber);
        
        return new ViewModel(array(
            'salonnumber' => $salonnumber,
            'appname'=>$appname,
            'homepage'=>$homepage,
            'account'=>$account
        ));
    }
    public function feedbackAction()
    {
        //订单id
        $sub=$this->params('sub');
        
        $feedback=$this->getFeedbacksMapper()->getTask($sub);
        return new ViewModel(array(
            'feedback' => $feedback
        ));
    }
    public function feedbacksearchAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;

        $feedbacks=$this->getFeedbacksMapper()->getFeedbackssalnumber($id);
        
        //搜索时间的转换
        $gmtfbdatebegin = date('YmdHis', strtotime($_GET['gmtfbdatebegin']));
        $gmtfbdatefinish = date('YmdHis', strtotime($_GET['gmtfbdatefinish']));
        $cars=array();
        foreach ($feedbacks as $feedback){
        
            if(preg_match("^".$_GET['cusname']."^", $feedback->getCusname())
                &&preg_match("^".$_GET['salname']."^", $feedback->getSalname())
                &&preg_match("^".$_GET['prodtitle']."^", $feedback->getProdtitle())
                &&preg_match("^".$_GET['cosname']."^", $feedback->getCosname())
                &&$gmtfbdatebegin=="19700101080000"&&$gmtfbdatefinish=="19700101080000"){
                    array_push($cars,array(
                        "id"=>$feedback->getId(),
                        "cusphoto"=>$feedback->getCusphoto(),
                        "cusname"=>$feedback->getCusname(),
                        "fbdate"=>$feedback->getFbdate(),
                        "salphoto1"=>$feedback->getSalphoto1(),
                        "salname"=>$feedback->getSalname(),
                        "fbsurrounding"=>$feedback->getFbsurrounding(),
                        "fbadvise"=>$feedback->getFbadvise(),
                        "prodtitle"=>$feedback->getProdtitle(),
                        "productcombinationname"=>$feedback->getProductcombinationname(),
                        "productcombinationpicture"=>$feedback->getProductcombinationpicture(),
                        "fbproduct"=>$feedback->getFbproduct(),
                        "fbadvise1"=>$feedback->getFbadvise1(),
                        "cosname"=>$feedback->getCosname(),
                        "cosphoto"=>$feedback->getCosphoto(),
                        "fbcosmetologist"=>$feedback->getFbcosmetologist(),
                        "fbadvise2"=>$feedback->getFbadvise2(),
                        "gmtfbdate"=>$feedback->getGmtfbdate()
                    ));
            }elseif(preg_match("^".$_GET['cusname']."^", $feedback->getCusname())
                &&preg_match("^".$_GET['salname']."^", $feedback->getSalname())
                &&preg_match("^".$_GET['prodtitle']."^", $feedback->getProdtitle())
                &&preg_match("^".$_GET['cosname']."^", $feedback->getCosname())
                &&$gmtfbdatebegin<=$feedback->getGmtfbdate()&&$feedback->getGmtfbdate()<=$gmtfbdatefinish){
                    array_push($cars,array(
                        "id"=>$feedback->getId(),
                        "cusphoto"=>$feedback->getCusphoto(),
                        "cusname"=>$feedback->getCusname(),
                        "fbdate"=>$feedback->getFbdate(),
                        "salphoto1"=>$feedback->getSalphoto1(),
                        "salname"=>$feedback->getSalname(),
                        "fbsurrounding"=>$feedback->getFbsurrounding(),
                        "fbadvise"=>$feedback->getFbadvise(),
                        "prodtitle"=>$feedback->getProdtitle(),
                        "productcombinationname"=>$feedback->getProductcombinationname(),
                        "productcombinationpicture"=>$feedback->getProductcombinationpicture(),
                        "fbproduct"=>$feedback->getFbproduct(),
                        "fbadvise1"=>$feedback->getFbadvise1(),
                        "cosname"=>$feedback->getCosname(),
                        "cosphoto"=>$feedback->getCosphoto(),
                        "fbcosmetologist"=>$feedback->getFbcosmetologist(),
                        "fbadvise2"=>$feedback->getFbadvise2(),
                        "gmtfbdate"=>$feedback->getGmtfbdate()
                    ));
            } }
            foreach ($cars as $key => $row) {
                $x[$key] = $row['id'];}
                if ($x){
                    array_multisort($x, SORT_DESC, $cars);
                }
        
        $paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($cars));
        $paginator->setCurrentPageNumber($this->params()->fromRoute('sub'));
        
        return new ViewModel(array(
            'carscount' => $cars,
            'cars'=>$paginator
        ));
    }
    
    
    public function feedbacksalcommentAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $sub=$this->params('sub');//反馈id
        
        $feedback=$this->getFeedbacksMapper()->getTask($sub);
        $form=new FeedbacksForm();
        $form->bind($feedback);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $feedback->setSalcomment1($post['salcomment1']);
            $feedback->setSalcomment2($post['salcomment2']);
            $feedback->setSalcomment3($post['salcomment3']);
            $feedback->setSalcommentdate(time());
            $this->getFeedbacksMapper()->saveTask($feedback);
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'feedbacksearch'
            ));
        }
        
        return new ViewModel(array('feedback'=>$feedback,'form'=>$form));
    }
    
    
    public function fooAction()
    {
        
        return new ViewModel();
    }
    public function appdownloadcommonAction()
    {
        
        return new ViewModel();
    }
    public function treatmentexpressAction()
    {
        
        return new ViewModel();
    }
    
    //curaddress
    public function curaddressAction()
    {
        $sub=$this->params('sub');//用户id
        $third=urldecode($this->params('third'));//地址
        
        $customer = $this->getCustomerMapper()->getCustomer1($sub);
        $customer->setCuraddress($third);
        $this->getCustomerMapper()->saveCustomer($customer);
        
        return new ViewModel();
    }

    public function nameAction()
    {
        $auth = new AuthenticationService();
        $dbAdapter = new DbAdapter(array(
            'driver' => 'Pdo_Mysql',
            'database' => 'company',
            'username' => 'root'
        ));
        $authAdapter = new AuthAdapter($dbAdapter, 'salon', 'salaccount', 'salpassword');
        $authAdapter->setIdentity('jiang')->setCredential('dong');
        $result = $auth->authenticate($authAdapter);
        $salarray = $authAdapter->getResultRowObject();
        $container = new Container('salonlogin');
        $container->salnumber = $salarray->salnumber;
        return array(
            'container' => $container,
            'result' => $result
        );
    }

    public function managementAction()
    {
        $form = new SalonForm();
        $salon = new SalonEntity();
        $form->bind($salon);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getSalonMapper()->saveSalon($salon);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic');
            }
        }
        
        return array(
            'form' => $form
        );
    }
    // TODO menu
    public function menuAction()
    {
        return new ViewModel();
        $this->layout()->setVariable('foo', 'bar');
    }
    // TODO login
    public function loginAction()
    {
        $sub = $this->params('sub'); // 美容院id
        
        $homepage = $homepage = $this->getPageMapper()->getHomepage($sub); // 美容院标识
        
        $form = new AccountForm();
        $salon = new AccountEntity();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                
                $accountlogin=$this->getAccountMapper()->getAccountlogin($_POST['salbossphone'],$_POST['salpassword']);
                
                if ($accountlogin!=null) {
                    
                    $container = new Container('salonlogin');
                    $container->salnumber = $accountlogin->getSalnumber();
                    return $this->redirect()->toRoute('cosmetic', array(
                        'action' => 'appqrcode'
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
        }
        return array(
            'homepage'=>$homepage,
            'form' => $form,
            'sub'=>$sub
        );
    }
    
    // TODO salon
    public function salonAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $mapper = $this->getSalonMapper();
        
        return new ViewModel(array(
            'container' => $container,
            'salons' => $mapper->getSalon($id),
            'id' => $id
        ));
    }

    public function salonaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $form = new SalonForm();
        $salon = new SalonEntity();
        
        $form->bind($salon);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getSalonMapper()->saveSalon($salon);
                if (! file_exists('public/salon/' . $id)) {
                    mkdir('public/salon/' . $id);
                }
                move_uploaded_file($y['salbossphotof']['tmp_name'], 'public/salon/' . $id . '/' . $x['salbossphoto']);
                move_uploaded_file($y['salphoto1f']['tmp_name'], 'public/salon/' . $id . '/' . $x['salphoto1']);
                move_uploaded_file($y['salphoto2f']['tmp_name'], 'public/salon/' . $id . '/' . $x['salphoto2']);
                move_uploaded_file($y['salphoto3f']['tmp_name'], 'public/salon/' . $id . '/' . $x['salphoto3']);
                // Redirect to list of tasks
                $newsalon=$this->getSalonMapper()->getSalonpicute($id,$post['salbranch']);//依据salnumber和分院号获取美容院
               //添加分院页面
                $pageEntity=new PageEntity();
                $pageEntity->setSalnumber($id);//美容院号
                $pageEntity->setPagetype("salonbranch");//类型
                $pageEntity->setPagename($post["salname"]);//名称
                $pageEntity->setPageheaddata1($newsalon->getSalid());//数据1对编号
                $pageEntity->setPageheaddata2($post["salbranch"]);//数据2对分院号
                $pageEntity->setPageheaddata3($post["salphoto1"]);//数据3对门头
                $salonBranchPage=$this->getPageMapper()->savePage($pageEntity); 
                //分院存入页面编号
                $salbranchpage=$this->getPageMapper()->getSalbranch($newsalon->getSalid());
                $newsalon->setPageid($salbranchpage->getPageid());
                $this->getSalonMapper()->saveSalon($newsalon);
                
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'salon'
                ));
            }
        }
        
        return array(
            'form' => $form,
            'id' => $id,
            'data' => $data
        );
    }

    public function saloneditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        if (! $id) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'salonadd'
            ));
        }
        $salon = $this->getSalonMapper()->getSalon1($sub);
        
        $form = new SalonForm();
        
        $form->bind($salon);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                
                $this->getSalonMapper()->saveSalon($salon);
                move_uploaded_file($y['salbossphotof']['tmp_name'], 'public/salon/' . $id . '/' . $x['salbossphoto']);
                move_uploaded_file($y['salphoto1f']['tmp_name'], 'public/salon/' . $id . '/' . $x['salphoto1']);
                move_uploaded_file($y['salphoto2f']['tmp_name'], 'public/salon/' . $id . '/' . $x['salphoto2']);
                move_uploaded_file($y['salphoto3f']['tmp_name'], 'public/salon/' . $id . '/' . $x['salphoto3']);
                // Redirect to list of tasks
                // return $this->redirect()->toRoute('cosmetic');
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'salon'
                ));
            }
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form
        );
    }

    public function salondeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $salon = $this->getSalonMapper()->getSalon1($sub);
        if (! $salon) {
            return $this->redirect()->toRoute('cosmetic');
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getPageMapper()->deleteSalbranch($salon->getSalid());//删除分院主页
                $this->getSalonMapper()->deleteSalon($sub);
            }
            
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'salon'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'salon' => $salon
        );
    }
    
    
    
    // TODO cosmetologist
    public function cosmetologistAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $mapper1 = $this->getCosmetologistMapper();
        $mapper2 = $this->getSalonMapper();
        return new ViewModel(array(
            'cosmetologists' => $mapper1->getCosmetologist($id),
            'salons' => $mapper2->getSalon($id),
            'id' => $id
        ));
    }

    public function cosmetologistaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        //分院选择
        $salbranches=$this->getSalonMapper()->getSalon($id);
        
        $form = new CosmetologistForm();
        $cosmetologist = new CosmetologistEntity();
        
        $form->bind($cosmetologist);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            //判断账号是否已存在
            $cosexist=$this->getCosmetologistMapper()->getCosexist($post['cosphone']);
            if ($cosexist){
                return array(
                    'form' => $form,
                    'id' => $id,
                    'data' => $data,
                    'post' => $post,
                    'salbranches'=>$salbranches,
                    'cosexist'=>$cosexist
                    
                );
            }
            
            
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                //保存单选框（分院编码）
                $cosmetologist->setSalbranch($post['salbranch']);
                $this->getCosmetologistMapper()->saveCosmetologist($cosmetologist);
                //取出此美容师，并将unread改为cos+cosid形式
                $cosunread=$this->getCosmetologistMapper()->getCosmetologistlogin($post['cosphone'],$post['cospassword']);
                $cosunread->setUnread("cos".$cosunread->getCosid());
                //$this->getCosmetologistMapper()->saveCosmetologist($cosunread);
                // Redirect to list of tasks
                
                
                //添加美容师页面
                $pageEntity=new PageEntity();
                $pageEntity->setSalnumber($id);//美容院号
                $pageEntity->setPagetype("cosmetologist");//类型
                $pageEntity->setPagename($post["cosname"]);//名称
                $pageEntity->setPageheaddata1($cosunread->getCosid());//数据1对编号id
                $pageEntity->setPageheaddata2($post["salbranch"]);//数据2对分院号
                $pageEntity->setPageheaddata3($post["cosphoto"]);//数据3对照片
                $salonBranchPage=$this->getPageMapper()->savePage($pageEntity); 
                
                //美容师存入页面编号
                $cosmetologistpage=$this->getPageMapper()->getCosmetologist($cosunread->getCosid());
                $cosunread->setPageid($cosmetologistpage->getPageid());
                $this->getCosmetologistMapper()->saveCosmetologist($cosunread);
                
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'cosmetologist'
                ));
            }
        }
        
        return array(
            'form' => $form,
            'id' => $id,
            'data' => $data,
            'post' => $post,
            'salbranches'=>$salbranches
            
        );
    }

    public function cosmetologisteditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        //分院选择
        $salbranches=$this->getSalonMapper()->getSalon($id);
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $cosmetologist = $this->getCosmetologistMapper()->getCosmetologist1($sub);
        
        $form = new CosmetologistForm();
        
        $form->bind($cosmetologist);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            //电话不同，则判断账号是否已存在
            if ($post['cosphone']!=$cosmetologist->getCosphone()){
            $cosexist=$this->getCosmetologistMapper()->getCosexist($post['cosphone']);
            if ($cosexist){
                return array(
                    'id' => $id,
                    'sub' => $sub,
                    'form' => $form,
                    'salbranches'=>$salbranches,
                    'cosexist'=>$cosexist
                    
                );
            }
            }
            
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                //保存单选框（分院编码）
                $cosmetologist->setSalbranch($post['salbranch']);
                $this->getCosmetologistMapper()->saveCosmetologist($cosmetologist);
                if (! file_exists('public/salon/' . $id)) {
                    mkdir('public/salon/' . $id);
                }
                
                move_uploaded_file($y['cosphotof']['tmp_name'], 'public/salon/' . $id . '/' . $x['cosphoto']);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'cosmetologist'
                ));
            }
        }
       
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form,
            'salbranches'=>$salbranches
        );
    }

    public function cosmetologistdeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $cosmetologist = $this->getCosmetologistMapper()->getCosmetologist1($sub);
        if (! $cosmetologist) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'cosmetologist'
            ));
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getPageMapper()->deleteCosmetologist($cosmetologist->getCosid());
                $this->getCosmetologistMapper()->deleteCosmetologist($sub);
            }
            
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'cosmetologist'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'cosmetologist' => $cosmetologist
        );
    }
    
    
    
    // TODO customer
    public function customerAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $mapper = $this->getCustomerMapper();
        $customers= $mapper->getCustomerandcusleveltype($id);
        
        //存入数组
        $cars=array();
        foreach ($customers as $customer){
            if(preg_match("^".$_GET['cusname']."^", $customer->getCusname())
                &&preg_match("^".$_GET['cuslevel']."^", $customer->getCuslevel())
                &&preg_match("^".$_GET['custype']."^", $customer->getCustype())
                &&preg_match("^".$_GET['cussalonbranch']."^", $customer->getCussalonbranch())){
                    array_push($cars,array(
                        "cusid"=>$customer->getCusid(),
                        "cusname"=>$customer->getCusname(),
                        "cusphone"=>$customer->getCusphone(),
                        "cuslevel"=>$customer->getCuslevel(),
                        "custype"=>$customer->getCustype(),
                        "cuspoints"=>$customer->getCuspoints(),
                        "cussalonbranch"=>$customer->getCussalonbranch(),
                        "cusregdate"=>$customer->getCusregdate(),
                        "cusregdatestamp"=>$customer->getCusregdatestamp(),
                        "cusphoto"=>$customer->getCusphoto()
                    ));
            } };
        
            foreach ($cars as $key => $row) {
                $x[$key] = $row['cuslevel'];}
                if ($x){
                    array_multisort($x, SORT_DESC, $cars);
                }
        
        $paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($cars));
        $paginator->setCurrentPageNumber($this->params()->fromRoute('sub'));
        
        
        return new ViewModel(array(
            'id' => $id,
            'cars'=>$paginator,
            'carscount'=>$cars
        ));
    }

    public function customeraddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $form = new CustomerForm();
        $customer = new CustomerEntity();
        
        $form->bind($customer);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getCustomerMapper()->saveCustomer($customer);
                if (! file_exists('public/salon/' . $id)) {
                    mkdir('public/salon/' . $id);
                }
                move_uploaded_file($y['cusphotof']['tmp_name'], 'public/salon/' . $id . '/' . $x['cusphoto']);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'customer'
                ));
            }
        }
        
        return array(
            'form' => $form,
            'id' => $id,
            'data' => $data,
            'post' => $post
        );
    }
    
    //顾客浏览记录
    public function cusbrowsinghistoryAction(){
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $cusdatebegin = date("YmdHis",strtotime($_POST['cusdatebegin']));
            $cusdatefinish = date("YmdHis",strtotime($_POST['cusdatefinish']));
            $cusbrowsingperson=$this->getCusbrowsinghistoryMapper()->getCusbrowsingongmtcusdate($id,$cusdatebegin,$cusdatefinish);
        }else{
            //默认今天访问的人
            $nowValue=date("YmdHis",time());
            $minValue=date("Ymd",time())."000000";
            $cusbrowsingperson=$this->getCusbrowsinghistoryMapper()->getCusbrowsingongmtcusdate($id,$minValue,$nowValue);
     
        }
        
        return array(
            'cusbrowsingperson'=>$cusbrowsingperson
        );
        
    }
    
    
    //编辑客户会员等级和需求类型
    public function cusleveltypeeditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
    
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        
        $cusleveltype=$this->getCusleveltypeMapper()->getTask($sub);
        $form = new CusleveltypeForm();
        if ($cusleveltype){
            $form->bind($cusleveltype);
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
    
                if ($cusleveltype){
                    $this->getCusleveltypeMapper()->saveTask($cusleveltype);
                }else{
                    $cusleveltype=new CusleveltypeEntity();
                    $cusleveltype->setCusid($sub);
                    $cusleveltype->setCuslevel($post['cuslevel']);
                    $cusleveltype->setCustype($post['custype']);
                    $this->getCusleveltypeMapper()->saveTask($cusleveltype);
                }
                
                //$this->getCustomerMapper()->saveCustomer($customer);
                //                 if (! file_exists('public/salon/' . $id)) {
                //                     mkdir('public/salon/' . $id);
                //                 }
    
                //                 move_uploaded_file($y['cusphotof']['tmp_name'], 'public/salon/' . $id . '/' . $x['cusphoto']);
    
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'customer'
                ));
            }
        }
    
        return array(
            'cusleveltype'=>$cusleveltype,
            'id' => $id,
            'sub' => $sub,
            'form' => $form
        );
    }
    
    public function customereditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $customer = $this->getCustomerMapper()->getCustomer1($sub);
       
        $form = new CustomerForm();
        
        $form->bind($customer);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                
                $this->getCustomerMapper()->saveCustomer($customer);
//                 if (! file_exists('public/salon/' . $id)) {
//                     mkdir('public/salon/' . $id);
//                 }
                
//                 move_uploaded_file($y['cusphotof']['tmp_name'], 'public/salon/' . $id . '/' . $x['cusphoto']);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'customer'
                ));
            }
        }
        
        return array(
            'customer'=>$customer,
            'id' => $id,
            'sub' => $sub,
            'form' => $form
        );
    }

    public function customerdeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $customer = $this->getCustomerMapper()->getCustomer1($sub);
        if (! $customer) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'customer'
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getCustomerMapper()->deleteCustomer($sub);
            }
            
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'customer'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'customer' => $customer
        );
    }
    // TODO product
    public function productAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $account=$this->getAccountMapper()->getAccount($id);
        
        $products = $this->getProductMapper()->getProductedit($id);
        return new ViewModel(array(
            'products' => $products,
            'id' => $id,
            'account'=>$account
        ));
    }

    public function productaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $form = new ProductForm();
        $product = new ProductEntity();
        //获取此美容院所有分类
        $demandclassifyseriess = $this->getDemandclassifyseriesMapper()->getDemandclassifyseries2($id);
        
        $form->bind($product);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $post['prodsales'] = "0";
           
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                if ($post['sharedstate']==0){
                    $product->setSharedstate($id);
                }
                $this->getProductMapper()->saveProduct($product);
                
                //创建此产品的详情页
                $form1 = new PageForm();
                $page1= new PageEntity();
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'product'
                ));
            }
        }
        return array(
            'form' => $form,
            'id' => $id,
            'data' => $data,
            'post' => $post,
            'demandclassifyseriess'=>$demandclassifyseriess
        );
    }

    public function producteditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        
        //获取此美容院所有分类
        $demandclassifyseriess = $this->getDemandclassifyseriesMapper()->getDemandclassifyseries2($id);
        
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $product = $this->getProductMapper()->getProduct1($sub);
        //由于.net framework浏览器内核不支持js对已有值的input再赋值
        //所以先清空产品分类，在赋值产品分类
        $classify=$product->getProddemandclassifyseries();
        $product->setProddemandclassifyseries("");
        
        $form = new ProductForm();
        
        $form->bind($product);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                if ($post['sharedstate']==0){
                    $product->setSharedstate($id);
                }
                $this->getProductMapper()->saveProduct($product);
                        // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'product'
                ));
            }
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form,
            'product'=>$product,
            'demandclassifyseriess'=>$demandclassifyseriess,
            'classify'=>$classify
        );
    }

    public function productdeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $product = $this->getProductMapper()->getProduct1($sub);
        if (! $product) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'product'
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getProductMapper()->deleteProduct($sub);
            }
            
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'product'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'product' => $product
        );
    }
    
    //TODO productcombination
    public function productcombinationAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        $product = $this->getProductMapper()->getProduct1($sub);
        
        $mapper = $this->getProductcombinationMapper();
        return array(
            'productcombinations' => $mapper->getProductcombination($sub),
            'sub'=>$sub,
            'product'=>$product,
        );
    }
    
    public function productcombinationaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        
        $form = new ProductcombinationForm();
        $productcombination = new ProductcombinationEntity();
    
        $form->bind($productcombination);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getProductcombinationMapper()->saveProductcombination($productcombination);
    
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'productcombination','sub'=>$sub
                ));
            }
        }
        return array(
            'form' => $form,
            'id' => $id,
            'sub'=>$sub,
            'data' => $data,
            'post' => $post
        );
    }
    public function productcombinationeditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        $third=(int) $this->params('third');
    
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $productcombination = $this->getProductcombinationMapper()->getProductcombination1($third);
    
        $form = new ProductcombinationForm();
    
        $form->bind($productcombination);
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
    
                $this->getProductcombinationMapper()->saveProductcombination($productcombination);
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'productcombination','sub'=>$sub
                ));
            }
        }
    
        return array(
            'id' => $id,
            'sub' => $sub,
            'third'=>$third,
            'form' => $form,
            'productcombination'=>$productcombination
        );
    }
    public function productcombinationdeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $third = $this->params('third');
        $productcombination = $this->getProductcombinationMapper()->getProductcombination1($third);
        if (! $productcombination) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'productcombination','sub'=>$sub
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getProductcombinationMapper()->deleteProductcombination($third);
            }
    
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'productcombination','sub'=>$sub
            ));
        }
    
        return array(
            'id' => $id,
            'sub' => $sub,
            'third'=>$third,
            'productcombination' => $productcombination
        );
    }
    
    // TODO treatment
    public function treatmentAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $treatments=$this->getTreatmentMapper()->getTreatment($id);
        
        //搜索时间的转换
        $gmtclosebegin = date('YmdHis', strtotime($_GET['gmtclosebegin']));
        $gmtclosefinish = date('YmdHis', strtotime($_GET['gmtclosefinish']));
        $cars=array();
        foreach ($treatments as $treatment){
            if($treatment->getGmtclose()!==null){
                $gmttimestamp = strtotime($treatment->getGmtclose());//时间换为时间戳
                $gmtclose = date('Y-m-d H:i:s', $gmttimestamp);
            }else {$gmtclose="";}
            if(preg_match("^".$_GET['trestate']."^", $treatment->getTrestate())&&
                preg_match("^".$_GET['prodtitle']."^", $treatment->getProdtitle())
                &&preg_match("^".$_GET['orderid']."^", $treatment->getOrderid())
                &&preg_match("^".$_GET['cusname']."^", $treatment->getCusname())
                &&$gmtclosebegin=="19700101080000"&&$gmtclosefinish=="19700101080000"){
                    switch ($_GET['ordertype']){
                    case 1:
                        if ($id==$treatment->getSalnumber()&&$id==$treatment->getProdsalnumber()){
                    array_push($cars,array(
                        "orderid"=>$treatment->getOrderid(),
                        "treid"=>$treatment->getTreid(),
                        "salnumber"=>$treatment->getSalnumber(),
                        "prodsalnumber"=>$treatment->getProdsalnumber(),
                        "productcombinationpicture"=>$treatment->getProductcombinationpicture(),
                        "prodtitle"=>$treatment->getProdtitle(),
                        "productcombinationname"=>$treatment->getProductcombinationname(),
                        "treprice"=>$treatment->getTreprice(),
                        "productquantity"=>$treatment->getProductquantity(),
                        "cusname"=>$treatment->getCusname(),
                        "trestate"=>$treatment->getTrestate(),
                        "treregdate"=>$treatment->getTreregdate(),
                        "treremark"=>$treatment->getTreremark(),
                        "gmtclose"=>$gmtclose
                    ));}
                break;
                    case 2:
                        if ($id!=$treatment->getSalnumber()&&$id==$treatment->getProdsalnumber()){
                            array_push($cars,array(
                                "orderid"=>$treatment->getOrderid(),
                                "treid"=>$treatment->getTreid(),
                                "salnumber"=>$treatment->getSalnumber(),
                                "prodsalnumber"=>$treatment->getProdsalnumber(),
                                "productcombinationpicture"=>$treatment->getProductcombinationpicture(),
                                "prodtitle"=>$treatment->getProdtitle(),
                                "productcombinationname"=>$treatment->getProductcombinationname(),
                                "treprice"=>$treatment->getTreprice(),
                                "productquantity"=>$treatment->getProductquantity(),
                                "cusname"=>$treatment->getCusname(),
                                "trestate"=>$treatment->getTrestate(),
                                "treregdate"=>$treatment->getTreregdate(),
                                "treremark"=>$treatment->getTreremark(),
                                "gmtclose"=>$gmtclose
                            ));}
                break;
                    case 3:
                        if ($id==$treatment->getSalnumber()&&$id!=$treatment->getProdsalnumber()){
                            array_push($cars,array(
                                "orderid"=>$treatment->getOrderid(),
                                "treid"=>$treatment->getTreid(),
                                "salnumber"=>$treatment->getSalnumber(),
                                "prodsalnumber"=>$treatment->getProdsalnumber(),
                                "productcombinationpicture"=>$treatment->getProductcombinationpicture(),
                                "prodtitle"=>$treatment->getProdtitle(),
                                "productcombinationname"=>$treatment->getProductcombinationname(),
                                "treprice"=>$treatment->getTreprice(),
                                "productquantity"=>$treatment->getProductquantity(),
                                "cusname"=>$treatment->getCusname(),
                                "trestate"=>$treatment->getTrestate(),
                                "treregdate"=>$treatment->getTreregdate(),
                                "treremark"=>$treatment->getTreremark(),
                                "gmtclose"=>$gmtclose
                            ));}
                break;
                    default:
                        array_push($cars,array(
                        "orderid"=>$treatment->getOrderid(),
                        "treid"=>$treatment->getTreid(),
                        "salnumber"=>$treatment->getSalnumber(),
                        "prodsalnumber"=>$treatment->getProdsalnumber(),
                        "productcombinationpicture"=>$treatment->getProductcombinationpicture(),
                        "prodtitle"=>$treatment->getProdtitle(),
                        "productcombinationname"=>$treatment->getProductcombinationname(),
                        "treprice"=>$treatment->getTreprice(),
                        "productquantity"=>$treatment->getProductquantity(),
                        "cusname"=>$treatment->getCusname(),
                        "trestate"=>$treatment->getTrestate(),
                        "treregdate"=>$treatment->getTreregdate(),
                        "treremark"=>$treatment->getTreremark(),
                        "gmtclose"=>$gmtclose
                        ));}
            }elseif(preg_match("^".$_GET['trestate']."^", $treatment->getTrestate())&&
                preg_match("^".$_GET['prodtitle']."^", $treatment->getProdtitle())
                &&preg_match("^".$_GET['orderid']."^", $treatment->getOrderid())
                &&preg_match("^".$_GET['cusname']."^", $treatment->getCusname())
                &&$gmtclosebegin<=$treatment->getGmtclose()&&$treatment->getGmtclose()<=$gmtclosefinish){
                    switch ($_GET['ordertype']){
                        case 1:
                            if ($id==$treatment->getSalnumber()&&$id==$treatment->getProdsalnumber()){
                                array_push($cars,array(
                                    "orderid"=>$treatment->getOrderid(),
                                    "treid"=>$treatment->getTreid(),
                                    "salnumber"=>$treatment->getSalnumber(),
                                    "prodsalnumber"=>$treatment->getProdsalnumber(),
                                    "productcombinationpicture"=>$treatment->getProductcombinationpicture(),
                                    "prodtitle"=>$treatment->getProdtitle(),
                                    "productcombinationname"=>$treatment->getProductcombinationname(),
                                    "treprice"=>$treatment->getTreprice(),
                                    "productquantity"=>$treatment->getProductquantity(),
                                    "cusname"=>$treatment->getCusname(),
                                    "trestate"=>$treatment->getTrestate(),
                                    "treregdate"=>$treatment->getTreregdate(),
                                    "treremark"=>$treatment->getTreremark(),
                                    "gmtclose"=>$gmtclose
                                ));}
                                break;
                        case 2:
                            if ($id!=$treatment->getSalnumber()&&$id==$treatment->getProdsalnumber()){
                                array_push($cars,array(
                                    "orderid"=>$treatment->getOrderid(),
                                    "treid"=>$treatment->getTreid(),
                                    "salnumber"=>$treatment->getSalnumber(),
                                    "prodsalnumber"=>$treatment->getProdsalnumber(),
                                    "productcombinationpicture"=>$treatment->getProductcombinationpicture(),
                                    "prodtitle"=>$treatment->getProdtitle(),
                                    "productcombinationname"=>$treatment->getProductcombinationname(),
                                    "treprice"=>$treatment->getTreprice(),
                                    "productquantity"=>$treatment->getProductquantity(),
                                    "cusname"=>$treatment->getCusname(),
                                    "trestate"=>$treatment->getTrestate(),
                                    "treregdate"=>$treatment->getTreregdate(),
                                    "treremark"=>$treatment->getTreremark(),
                                    "gmtclose"=>$gmtclose
                                ));}
                                break;
                        case 3:
                            if ($id==$treatment->getSalnumber()&&$id!=$treatment->getProdsalnumber()){
                                array_push($cars,array(
                                    "orderid"=>$treatment->getOrderid(),
                                    "treid"=>$treatment->getTreid(),
                                    "salnumber"=>$treatment->getSalnumber(),
                                    "prodsalnumber"=>$treatment->getProdsalnumber(),
                                    "productcombinationpicture"=>$treatment->getProductcombinationpicture(),
                                    "prodtitle"=>$treatment->getProdtitle(),
                                    "productcombinationname"=>$treatment->getProductcombinationname(),
                                    "treprice"=>$treatment->getTreprice(),
                                    "productquantity"=>$treatment->getProductquantity(),
                                    "cusname"=>$treatment->getCusname(),
                                    "trestate"=>$treatment->getTrestate(),
                                    "treregdate"=>$treatment->getTreregdate(),
                                    "treremark"=>$treatment->getTreremark(),
                                    "gmtclose"=>$gmtclose
                                ));}
                                break;
                        default:
                            array_push($cars,array(
                            "orderid"=>$treatment->getOrderid(),
                            "treid"=>$treatment->getTreid(),
                            "salnumber"=>$treatment->getSalnumber(),
                            "prodsalnumber"=>$treatment->getProdsalnumber(),
                            "productcombinationpicture"=>$treatment->getProductcombinationpicture(),
                            "prodtitle"=>$treatment->getProdtitle(),
                            "productcombinationname"=>$treatment->getProductcombinationname(),
                            "treprice"=>$treatment->getTreprice(),
                            "productquantity"=>$treatment->getProductquantity(),
                            "cusname"=>$treatment->getCusname(),
                            "trestate"=>$treatment->getTrestate(),
                            "treregdate"=>$treatment->getTreregdate(),
                            "treremark"=>$treatment->getTreremark(),
                            "gmtclose"=>$gmtclose
                            ));}
            } }
            foreach ($cars as $key => $row) {
                $x[$key] = $row['treid'];}
                if ($x){
                    array_multisort($x, SORT_DESC, $cars);
                }
        
                $paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($cars));
                $paginator->setCurrentPageNumber($this->params()->fromRoute('sub'));
                
        return new ViewModel(array(
            'carscount'=>$cars,
            'cars'=>$paginator,
            'id' => $id
        ));
    }

    public function treatmentaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $form = new TreatmentForm();
        $treatment = new TreatmentEntity();
        
        $form->bind($treatment);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getTreatmentMapper()->saveTreatment($treatment);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'treatment'
                ));
            }
        }
        return array(
            'form' => $form,
            'id' => $id,
            'data' => $data,
            'post' => $post
        );
    }

    public function treatmenteditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        
       
        
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $treatment = $this->getTreatmentMapper()->getTreatment1($sub);
        
        $form = new TreatmentForm();
        
        $form->bind($treatment);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                
                $this->getTreatmentMapper()->saveTreatment($treatment);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'treatment'
                ));
            }
        }
        
        $feedbacks=$this->getFeedbacksMapper()->getTask2($sub);
        $account=$this->getAccountMapper()->getAccount($treatment->getSalnumber());
        $customer=$this->getCustomerMapper()->getCustomer1($treatment->getCusid());
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form,
            'treatment'=>$treatment,
            'feedbacks'=>$feedbacks,
            'account'=>$account,
            'customer'=>$customer
        );
    }

    public function treatmentdeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $treatment = $this->getTreatmentMapper()->getTreatment1($sub);
        if (! $treatment) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'treatment'
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getTreatmentMapper()->deleteTreatment($sub);
            }
            
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'treatment'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'treatment' => $treatment
        );
    }
   
    // TODO appointment
    public function appointmentAction()
    {
        
        return new ViewModel();
    }
    
    public function appointmentpassAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        //按id取出预约,替换值,保存
        $appointmentpending=$this->getAppointmentMapper()->getAppointment1($_POST['appointmentid']);
        $appointmentpending->setAppointmentstate("已通过");
        
        $this->getAppointmentMapper()->saveAppointment($appointmentpending);
        
        return new ViewModel(array(
            'appointmentid'=>$_POST['appointmentid']
        ));
    }
    
    public function appointmentajaxAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $salonmapper=$this->getSalonMapper();
        $mapper = $this->getAppointmentMapper();
        
        $request = $this->getRequest();
        $post=$request->getPost()->toArray();
        
        if ($post['ajaxValue']!=""){
            $appintments=$mapper->getAppointmentDate($id,$post['ajaxValue']);
        }else {
            $appintments=$mapper->getAppointmentsalon($id);
        }
        return new ViewModel(array(
            'appointments' => $appintments,
            'id' => $id,
            'salons' => $salonmapper->getSalon($id)
        ));
    }

    public function appointmentaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $form = new AppointmentForm();
        $appointment = new AppointmentEntity();
        
        $form->bind($appointment);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getAppointmentMapper()->saveAppointment($appointment);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'appointment'
                ));
            }
        }
        return array(
            'form' => $form,
            'id' => $id,
            'data' => $data,
            'post' => $post
        );
    }

    public function appointmenteditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $appointment = $this->getAppointmentMapper()->getAppointment1($sub);
        
        $form = new AppointmentForm();
        
        $form->bind($appointment);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                
                $this->getAppointmentMapper()->saveAppointment($appointment);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'appointment'
                ));
            }
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form
        );
    }

    public function appointmentdeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $appointment = $this->getAppointmentMapper()->getAppointment1($sub);
        if (! $appointment) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'appointment'
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getAppointmentMapper()->deleteAppointment($sub);
            }
            
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'appointment'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'appointment' => $appointment
        );
    }
   
 
    // TODO saloncouponissue
    public function saloncouponissueAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $mapper = $this->getSaloncouponissueMapper();
        return new ViewModel(array(
            'saloncouponissues' => $mapper->getSaloncouponissue($id),
            'id' => $id
        ));
    }

    public function saloncouponissueaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $form = new SaloncouponissueForm();
        $saloncouponissue = new SaloncouponissueEntity();
        
        $form->bind($saloncouponissue);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $saloncouponissue->setComparedate(strtotime($post['sciavailable']));
                $this->getSaloncouponissueMapper()->saveSaloncouponissue($saloncouponissue);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'saloncouponissue'
                ));
            }
        }
        return array(
            'form' => $form,
            'id' => $id,
            'data' => $data,
            'post' => $post
        );
    }

    public function saloncouponissueeditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $saloncouponissue = $this->getSaloncouponissueMapper()->getSaloncouponissue1($sub);
        
        $form = new SaloncouponissueForm();
        
        $form->bind($saloncouponissue);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                
                $this->getSaloncouponissueMapper()->saveSaloncouponissue($saloncouponissue);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'saloncouponissue'
                ));
            }
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form
        );
    }

    public function saloncouponissuedeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $saloncouponissue = $this->getSaloncouponissueMapper()->getSaloncouponissue1($sub);
        if (! $saloncouponissue) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'saloncouponissue'
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getSaloncouponissueMapper()->deleteSaloncouponissue($sub);
            }
            
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'saloncouponissue'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'saloncouponissue' => $saloncouponissue
        );
    }
    // TODO picture uploading
    public function pictureAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        
 
        return new ViewModel(array(
            
            'id' => $id,
            'sub' => $this->params('sub'),
            'third' => $this->params('third'),
        ));
    }

    
    public function pictureaddAction(){
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $third = $this->params('third');
        
        return array('id'=>$id,'sub'=>$sub,'third'=>$third);
    }
    
    //由于dropzone的原因，已采用
    public function pictureaddajaxAction(){
        $sub = $this->params('sub');
        $third = $this->params('third');
        $fourth = $this->params('fourth');
        
        if($third==null){
        $file=$_FILES['file'];
        $pname = iconv('utf-8', 'gbk', $_FILES['file']['name']);
        $pname1=iconv('utf-8', 'gbk', 'public/salon/'.$sub.'/');//文件路径
        $pname2=iconv('utf-8', 'gbk', $_FILES['file']['tmp_name']);
        move_uploaded_file($pname2, $pname1.$pname);
        }elseif ($fourth==null&&$third!=null){
            $file=$_FILES['file'];
            $pname = iconv('utf-8', 'gbk', $_FILES['file']['name']);
            $pname1=iconv('utf-8', 'gbk', 'public/salon/'.$sub.'/'.$third.'/');//文件路径
            $pname2=iconv('utf-8', 'gbk', $_FILES['file']['tmp_name']);
            move_uploaded_file($pname2, $pname1.$pname);
        }elseif ($fourth!=null) {
            $file=$_FILES['file'];
            $pname = iconv('utf-8', 'gbk', $_FILES['file']['name']);
            $pname1=iconv('utf-8', 'gbk', 'public/salon/'.$sub.'/'.$third.'/'.$fourth.'/');//文件路径
            $pname2=iconv('utf-8', 'gbk', $_FILES['file']['tmp_name']);
            move_uploaded_file($pname2, $pname1.$pname);
        }
        return array('filename'=>$_FILES['file']['name']);
    }
    
    //由于dropzone的原因，已作废
    public function pictureaddtestAction()
    {
        //$container = new Container('salonlogin');
        //$id = $container->salnumber;
        $sub = $this->params('sub');
        $id = $this->params('third');
        

        $request = $this->getRequest();
        if ($request->isPost()) {
                $y = $request->getFiles()->toArray();
                if($sub==null){
                foreach ($y['file'] as $picturesrc) {
                    $pname = iconv('utf-8', 'gbk', $picturesrc['name']);
                    $pname1=iconv('utf-8', 'gbk', 'public/salon/'.$id.'/');//文件路径
                    $pname2=iconv('utf-8', 'gbk', $picturesrc['tmp_name']);
                        //缩放
                    $temp = explode(".", $pname);
                    $extension = end($temp);
                    
                    //视频文件直接保存,图片按后缀缩放
                    if ($extension=="mp4"){
                        move_uploaded_file($pname2, $pname1.$pname);
                    }elseif($extension=="jpg"||$extension=="jpeg"||$extension=="gif"||$extension=="png"){
                        $filename=$pname2;
                        list($width, $height)=getimagesize($filename);
                        if ($width>800||$height>800){//长或宽大于1000则缩放
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
                                default:
                                   return $this->redirect()->toRoute('cosmetic', array(
                                          'action' => 'picture'
                                     ));
                            }
                            imagedestroy($new);
                            imagedestroy($img);
                            
                        }else{
                            move_uploaded_file($pname2, $pname1.$pname);
                        }
                        
                    }else{
                        return $this->redirect()->toRoute('cosmetic', array(
                            'action' => 'picture'
                        ));
                    }
                        
                }
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'picture'
                ));
                }else {
                    foreach ($y['file'] as $picturesrc) {
                        $pname = iconv('utf-8', 'gbk', $picturesrc['name']);//文件名
                        $pname1=iconv('utf-8', 'gbk', 'public/salon/'.$id.'/'.$sub.'/');//文件路径
                        $pname2=iconv('utf-8', 'gbk', $picturesrc['tmp_name']);//临时文件名
                        
                        //缩放
                    $temp = explode(".", $pname);
                    $extension = end($temp);
                    
                    //视频文件直接保存,图片按后缀缩放
                    if ($extension=="mp4"){
                        move_uploaded_file($pname2, $pname1.$pname);
                    }elseif($extension=="jpg"||$extension=="jpeg"||$extension=="gif"||$extension=="png"){
                        $filename=$pname2;
                        list($width, $height)=getimagesize($filename);
                        if ($width>800||$height>800){//长或宽大于1000则缩放
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
                                 default:
                                     return $this->redirect()->toRoute('cosmetic', array(
                                          'action' => 'picture','sub'=>$sub
                                     ));
                            }
                            imagedestroy($new);
                            imagedestroy($img);
                            
                        }else{
                            move_uploaded_file($pname2, $pname1.$pname);
                        }
                        
                    }else{
                        return $this->redirect()->toRoute('cosmetic', array(
                        'action' => 'picture','sub'=>$sub
                    ));
                    }
                        //$newfilename1 = $this->newfilename(15, $pname);
                        //move_uploaded_file($pname2, $pname1.$newfilename1);
                    }
                    // Redirect to list of tasks
                    return $this->redirect()->toRoute('cosmetic', array(
                        'action' => 'picture','sub'=>$sub
                    ));
                }
        }
        return array(
            'id' => $id,
            'sub'=>$sub
        );
    }
    public function picturediraddAction()
    {
        
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $path = iconv('utf-8', 'gbk', $post["dirname"]);
            if ($sub==null){
            mkdir('public/salon/'.$id.'/'.$path);
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'picture'
            ));
            }else {
            mkdir('public/salon/'.$id.'/'.$sub.'/'.$path);
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'picture','sub'=>$sub
            ));
            }
            
        }
        return array('sub'=>$sub);
        
    }
    public function picturedeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $third=$this->params('third');
        $fourth=$this->params('fourth');
        
        if($third==null){
        $filename='public/salon/'.$id.'/'.$sub;
        $path = iconv('utf-8', 'gbk', $filename);
        if (substr(strrchr($sub, '.'), 1)==null){ 
           $this->delAllDir($path);
            rmdir($path);
        }else{
        unlink($path);}
        return $this->redirect()->toRoute('cosmetic', array(
            'action' => 'picture'
        ));
        }elseif ($third!=null&&$fourth==null){
            $filename='public/salon/'.$id.'/'.$sub.'/'.$third;
            $path = iconv('utf-8', 'gbk', $filename);
            if (substr(strrchr($third, '.'), 1)==null){ 
             $this->delAllDir($path);
                rmdir($path);
            }else{
            unlink($path);}
            return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'picture','sub'=>$sub
            ));
        }elseif ($fourth!=null){
            $filename='public/salon/'.$id.'/'.$sub.'/'.$third.'/'.$fourth;
            $path = iconv('utf-8', 'gbk', $filename);
            unlink($path);
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'picture','sub'=>$sub,'third'=>$third
            ));
        }
       
    }
    
    // TODO page generation
    public function pageAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
    
        $pages = $this->getPageMapper()->getPage($id);
        return new ViewModel(array(
            'pages' => $pages,
            'id' => $id
        ));
    }
    public function pageaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
    
        $form = new PageForm();
        $page = new PageEntity();
    
        $form->bind($page);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getPageMapper()->savePage($page);
    
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'page'
                ));
            }
        }
        return array(
            'form' => $form,
            'id' => $id,
            'data' => $data,
            'post' => $post
        );
    }
    public function pageeditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
    
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $page = $this->getPageMapper()->getPage1($sub);
    
        $form = new PageForm();
    
        $form->bind($page);
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $post['modificationtime'] = date("Y-m-d H:i:s",time());
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
    
                $this->getPageMapper()->savePage($page);
    
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'page'
                ));
            }
        }
    
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form,
            'page'=>$page
        );
    }
    public function pagedeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $page = $this->getPageMapper()->getPage1($sub);
        if (! $page) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'page'
            ));
        }
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getPageMapper()->deletePage($sub);
                $this->getTemplateMapper()->deleteTemplate($sub);
            }
    
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'page'
            ));
        }
    
        return array(
            'id' => $id,
            'sub' => $sub,
            'page' => $page
        );
    }
    
    //TODO Demandclassifyseries
    public function demandclassifyseriesAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
    
        $demandclassifyseriess = $this->getDemandclassifyseriesMapper()->getDemandclassifyseries2($id);
        return array(
            'demandclassifyseriess' => $demandclassifyseriess,
            'id' => $id
        );
    }
    public function demandclassifyseriesaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
    
        $form = new DemandclassifyseriesForm();
        $demandclassifyseries = new DemandclassifyseriesEntity();
    
        $form->bind($demandclassifyseries);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getDemandclassifyseriesMapper()->saveDemandclassifyseries($demandclassifyseries);
    
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'demandclassifyseries'
                ));
            }
        }
        return array(
            'form' => $form,
            'id' => $id,
            'data' => $data,
            'post' => $post
        );
    }
    public function demandclassifyserieseditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
    
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
     
        }
        $demandclassifyseries = $this->getDemandclassifyseriesMapper()->getDemandclassifyseries1($sub);
    
        $form = new DemandclassifyseriesForm();
    
        $form->bind($demandclassifyseries);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
    
                $this->getDemandclassifyseriesMapper()->saveDemandclassifyseries($demandclassifyseries);
    
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'demandclassifyseries'
                ));
            }
        }
    
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form
        );
    }
    public function demandclassifyseriesdeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $demandclassifyseries = $this->getDemandclassifyseriesMapper()->getDemandclassifyseries1($sub);
        if (! $demandclassifyseries) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'demandclassifyseries'
            ));
        }
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getDemandclassifyseriesMapper()->deleteDemandclassifyseries($sub);
            }
    
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'demandclassifyseries'
            ));
        }
    
        return array(
            'id' => $id,
            'sub' => $sub,
            'demandclassifyseries' => $demandclassifyseries
        );
    }
    
    //TODO Account
    public function accountAction()
    {
    
        $mapper = $this->getAccountMapper();
        return array(
            'accounts' => $mapper->fetchAll(),
          
        );
    }
    public function accountaddAction()
    {
        
        $form = new AccountForm();
        $account = new AccountEntity();
        $form->bind($account);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getAccountMapper()->saveAccount($account);
            }
            
             $page = new PageEntity();
             $page->setPagetype("首页");
             $page->setSalnumber($post['salnumber']);
             $page->setPagename("首页");
             $this->getPageMapper()->savePage($page);
             if (! file_exists('public/salon/'.$post['salnumber'])) {
                 mkdir('public/salon/'.$post['salnumber']);
             }
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'account'
                ));
            
            
        }
        return array(
            'form' => $form,
            'data' => $data,
            'post' => $post
        );
    }
    public function accounteditAction()
    {
        
        $sub = (int) $this->params('sub');
    
    
        $account = $this->getAccountMapper()->getAccount1($sub);
    
        $form = new AccountForm();
    
        $form->bind($account);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
    
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
    
                $this->getAccountMapper()->saveAccount($account);
    
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'account'
                ));
            }
        }
    
        return array(
          
            'sub' => $sub,
            'form' => $form
        );
    }
    public function accountdeleteAction()
    {

        $sub = $this->params('sub');
        $account = $this->getAccountMapper()->getAccount1($sub);
        if (! $account) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'account'
            ));
        }
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getAccountMapper()->deleteAccount($sub);
            }
    
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'account'
            ));
        }
    
        return array(
            
            'sub' => $sub,
            'account' => $account
        );
    }
    
    //TODO 通知notofication
    public function notificationinfoAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
    
        $notifications=$this->getNotificationinfoMapper()->getTask1($id);
        return new ViewModel(array(
            'notifications' => $notifications,
            'id' => $id
        ));
    }
    public function notificationinfoaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $form = new NotificationinfoForm();
        $task = new NotificationinfoEntity();
        $form->bind($task);
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $task->setSalnumber($id);
    
                //增加ios通知 1.取出全部deviceToken，循环发送
                $customers=$this->getCustomerMapper()->getCustomer($id);
                foreach ($customers as $customer){
                    $deviceToken=$customer->getCustoken();
                    $passphrase='j12321456';
                    $message=$task->getNotitle().":".$task->getNocontent();
                    $ctx = stream_context_create();
                    stream_context_set_option($ctx, 'ssl', 'allow_self_signed', true);
                    stream_context_set_option($ctx, 'ssl', 'verify_peer', false);
                    stream_context_set_option($ctx, 'ssl', 'local_cert', 'public/pushcertificate/123/customerios.pem');
                    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                    
                    // Open a connection to the APNS server
                    //这个为正是的发布地址
                    $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
                    //这个是沙盒测试地址，发布到appstore后记得修改哦
                    //$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
                    
                    
                    // Create the payload body
                    $body['aps'] = array(
                        'alert' => $message,
                        'sound' => 'default',
                        "badge" => 1
                    );
                    
                    // Encode the payload as JSON
                    $payload = json_encode($body);
                    
                    // Build the binary notification
                    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                    
                    // Send it to the server
                    $result = fwrite($fp, $msg, strlen($msg));
                    
                    fclose($fp);
                }
                
                $this->getNotificationinfoMapper()->saveTask($task);
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'Notificationinfo'
                ));
            }
        }
        //链接需要的对象：产品，页面，分类，首页
        $products = $this->getProductMapper()->getProduct($id);
        $pagesactivity = $this->getPageMapper()->getPageactivity($id);
        $pagesalonbranch = $this->getPageMapper()->getPagesalonbranch($id);//美容院分页
        $pagecosmetologist = $this->getPageMapper()->getPagecosmetologist($id);//美容师分页
        $demandclassifyseriess = $this->getDemandclassifyseriesMapper()->getDemandclassifyseries2($id);
        return array(
            'id'=>$id,
            'form' => $form,
            'products'=>$products,
            'pagesactivity'=>$pagesactivity,
            'pagesalonbranch'=>$pagesalonbranch,
            'pagecosmetologist'=>$pagecosmetologist,
            'demandclassifyseriess'=>$demandclassifyseriess
        );
    }
    
    public function notificationinfoeditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $sub = (int)$this->params('sub');
        
        if (!$sub) {
            return $this->redirect()->toRoute('cosmetic', array('action'=>'Notificationinfo'));
        }
        $task = $this->getNotificationinfoMapper()->getTask($sub);
    
        $form = new NotificationinfoForm();
        $form->bind($task);
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $task->setSalnumber($id);
                $this->getNotificationinfoMapper()->saveTask($task);
    
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'Notificationinfo'
                ));
            }
        }
        //链接需要的对象：产品，页面，分类，首页
        $products = $this->getProductMapper()->getProduct($id);
        $pagesactivity = $this->getPageMapper()->getPageactivity($id);
        $pagesalonbranch = $this->getPageMapper()->getPagesalonbranch($id);//美容院分页
        $pagecosmetologist = $this->getPageMapper()->getPagecosmetologist($id);//美容师分页
        $demandclassifyseriess = $this->getDemandclassifyseriesMapper()->getDemandclassifyseries2($id);
        return array(
            'id'=>$id,
            'sub'=>$sub,
            'form' => $form,
            'products'=>$products,
            'pagesactivity'=>$pagesactivity,
            'pagesalonbranch'=>$pagesalonbranch,
            'pagecosmetologist'=>$pagecosmetologist,
            'demandclassifyseriess'=>$demandclassifyseriess
        );
    }
    
    public function notificationinfodeleteAction()
    {
        $id = $this->params('sub');
        $task = $this->getNotificationinfoMapper()->getTask($id);
        if (!$task) {
            return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'Notificationinfo'
                ));
        }
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getNotificationinfoMapper()->deleteTask($id);
            }
    
            return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'Notificationinfo'
                ));
        }
    
        return array(
            'id' => $id,
            'notification' => $task
        );
    }
    
    public function notificationxmlAction(){
        
    }
    //TODO 自定义按钮
    public function custombuttonAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
    
        $custombuttons = $this->getCustombuttonMapper()->getCustombuttons($id);
        return new ViewModel(array(
            'custombuttons' => $custombuttons,
            'id' => $id
        ));
    }
    public function custombuttonaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
    
        $form = new CustombuttonForm();
        $custombutton = new CustombuttonEntity();
    
        
        $form->bind($custombutton);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getCustombuttonMapper()->saveCustombutton($custombutton);
    
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'custombutton'
                ));
            }
        }
        //链接需要的对象：产品，页面，分类，首页
        $products = $this->getProductMapper()->getProduct($id);
        $pagesactivity = $this->getPageMapper()->getPageactivity($id);
        $pagesalonbranch = $this->getPageMapper()->getPagesalonbranch($id);//美容院分页
        $pagecosmetologist = $this->getPageMapper()->getPagecosmetologist($id);//美容师分页
        $demandclassifyseriess = $this->getDemandclassifyseriesMapper()->getDemandclassifyseries2($id);
        return array(
            'form' => $form,
            'id' => $id,
            'products'=>$products,
            'pagesactivity'=>$pagesactivity,
            'pagesalonbranch'=>$pagesalonbranch,
            'pagecosmetologist'=>$pagecosmetologist,
            'demandclassifyseriess'=>$demandclassifyseriess
        );
    }
    
    public function custombuttoneditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
    
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $custombutton = $this->getCustombuttonMapper()->getCustombutton($sub);
    
        $form = new CustombuttonForm();
    
        $form->bind($custombutton);
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
    
                $this->getCustombuttonMapper()->saveCustombutton($custombutton);
    
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'custombutton'
                ));
            }
        }
        //链接需要的对象：产品，页面，分类，首页
        $products = $this->getProductMapper()->getProduct($id);
        $pagesactivity = $this->getPageMapper()->getPageactivity($id);
        $pagesalonbranch = $this->getPageMapper()->getPagesalonbranch($id);//美容院分页
        $pagecosmetologist = $this->getPageMapper()->getPagecosmetologist($id);//美容师分页
        $demandclassifyseriess = $this->getDemandclassifyseriesMapper()->getDemandclassifyseries2($id);
        return array(
            'form' => $form,
            'sub'=>$sub,
            'id' => $id,
            'products'=>$products,
            'pagesactivity'=>$pagesactivity,
            'pagesalonbranch'=>$pagesalonbranch,
            'pagecosmetologist'=>$pagecosmetologist,
            'demandclassifyseriess'=>$demandclassifyseriess
        );
    }
    
    public function custombuttondeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $custombutton = $this->getCustombuttonMapper()->getCustombutton($sub);
        if (! $custombutton) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'custombutton'
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getCustombuttonMapper()->deleteCustombutton($sub);
            }
    
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'custombutton'
            ));
        }
    
        return array(
            'id' => $id,
            'sub' => $sub,
            'custombutton' => $custombutton
        );
    }
    
    public function activityregisterAction(){
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        
        $activityregister=$this->getSignupMapper()->getActivityregister($sub);
        return array('activityregister'=>$activityregister);
    }
    
    public function iosdownloadAction(){
        $sub=$this->params('sub');
        $third=$this->params('third');
        
        $homepage=$homepage=$this->getPageMapper()->getHomepage($sub);//美容院标识
        
        return array('sub'=>$sub,'third'=>$third,'homepage'=>$homepage);
    }
    
    
    //TODO lotterycheck
    public function lotterycheckAction(){
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        //$sub = $this->params('sub');
        
        $lotterychecks=$this->getLotteryMapper()->getLotterysal($id);
        
        //存入数组
        $cars=array();
        foreach ($lotterychecks as $lotterycheck){
            if(preg_match("^".$_GET['cusname']."^", $lotterycheck->getCusname())){
                    array_push($cars,array(
                        "cusid"=>$lotterycheck->getCusid(),
                        "cusname"=>$lotterycheck->getCusname(),
                        "cusphone"=>$lotterycheck->getCusphone(),
                        "cusphoto"=>$lotterycheck->getCusphoto(),
                        "winningtime"=>$lotterycheck->getWinningtime(),
                        "prizepicture"=>$lotterycheck->getPrizepicture(),
                        "receivetime"=>$lotterycheck->getReceivetime(),
                        "receivestate"=>$lotterycheck->getReceivestate(),
                        "lotterytype"=>$lotterycheck->getLotterytype()
                    ));
            } };
            
            foreach ($cars as $key => $row) {
                $x[$key] = $row['winningtime'];}
                if ($x){
                    array_multisort($x, SORT_DESC, $cars);
                }
                
                $paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($cars));
                $paginator->setCurrentPageNumber($this->params()->fromRoute('sub'));
                
                
        
                return new ViewModel(array(
                    'id' => $id,
                    'cars'=>$paginator,
                    'carscount'=>$cars
                ));
    }
    
    //TODO tipcheck
    public function tipcheckAction(){
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        //$sub = $this->params('sub');
        
        $tipchecks=$tiplist=$this->getTipMapper()->getTask3($id);
        
        //存入数组
        $cars=array();
        foreach ($tipchecks as $tipcheck){
            if(preg_match("^".$_GET['cusname']."^", $tipcheck->getCusname())&&preg_match("^".$_GET['cosname']."^", $tipcheck->getCosname())){
                array_push($cars,array(
                    "cusid"=>$tipcheck->getCusid(),
                    "cusname"=>$tipcheck->getCusname(),
                    "cusphoto"=>$tipcheck->getCusphoto(),
                    "cosid"=>$tipcheck->getCosid(),
                    "cosname"=>$tipcheck->getCosname(),
                    "cosphoto"=>$tipcheck->getCosphoto(),
                    "gmtclose"=>$tipcheck->getGmtclose(),
                    "tipmoney"=>$tipcheck->getTipmoney(),
                    "paymethod"=>$tipcheck->getPaymethod(),
                    "payid"=>$tipcheck->getPayid()
                ));
            }};
            
            foreach ($cars as $key => $row) {
                $x[$key] = $row['gmtclose'];
                $y[$key] = $row['tipmoney'];}
                if ($x){
                    array_multisort($x, SORT_DESC, $cars);
                }
                
                $paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($cars));
                $paginator->setCurrentPageNumber($this->params()->fromRoute('sub'));
                
                
                
                return new ViewModel(array(
                    'id' => $id,
                    'cars'=>$paginator,
                    'carscount'=>$cars,
                    'tipmoney'=>$y
                ));
    }
    
    //TODO cusregister客户注册
    // TODO register
    public function cusregisterAction()
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
                    //默认头像
                    if(!$post['cusphoto']){
                        $post['cusphoto']="genderfemale.png";
                    }
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
                            if ($width>500||$height>500){//长或宽大于500则缩放
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
                        
                        
                        //取出cus
                        $customer = $this->getCustomerMapper()->getCustomerexist($post['cusphone']);
                        //存入等级类型
                        $cusleveltype=new CusleveltypeEntity();
                        $cusleveltype->setCusid($customer->getCusid());
                        $cusleveltype->setCuspoints(0);
                        $cusleveltype->setCuslevel(0);
                        $this->getCusleveltypeMapper()->saveTask($cusleveltype);
                        
                        
                        
                        // 设置session
                        $container = new Container('customerlogin');
                        $container->salnumber = $sub;
                        $container->cusid = $customer->getCusid();
                        $container->cusname = $customer->getCusname();
                        $container->cusphone = $customer->getCusphone();
                        $container->cusphoto = $customer->getCusphoto();
                        
                        // Redirect to list of tasks
                        return $this->redirect()->toRoute('cosmetic', array(
                            'action' => 'customer'
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
    
    //TODO banprod
    public function banprodAction(){
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $account=$this->getAccountMapper()->getAccount($id);
        $account->setBanprod($_POST['banswich']);
        
        $this->getAccountMapper()->saveAccount($account);
        return array();
    }
}