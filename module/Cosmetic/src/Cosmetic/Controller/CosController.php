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
                    delAllDir($fullpath);
                }else
                {
                    unlink($fullpath);
                }
                @rmdir($fullpath);
            }
    
        }
        return true;
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
                
                $accountlogin=$this->getAccountMapper()->getAccountlogin($_POST['salaccount'],$_POST['salpassword']);
                
                if ($accountlogin!=null) {
                    
                    $container = new Container('salonlogin');
                    $container->salnumber = $accountlogin->getSalnumber();
                    return $this->redirect()->toRoute('cosmetic', array(
                        'action' => 'salon'
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
    
    // TODO promotion
    public function promotionAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $mapper = $this->getPromotionMapper();
        return new ViewModel(array(
            'promotions' => $mapper->getPromotion($id),
            'id' => $id
        ));
    }

    public function promotionaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $form = new PromotionForm();
        $promotion = new PromotionEntity();
        
        $form->bind($promotion);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getPromotionMapper()->savePromotion($promotion);
                if (! file_exists('public/salon/' . $id)) {
                    mkdir('public/salon/' . $id);
                }
                move_uploaded_file($y['promphoto1f']['tmp_name'], 'public/salon/' . $id . '/' . $x['promphoto1']);
                move_uploaded_file($y['promphoto2f']['tmp_name'], 'public/salon/' . $id . '/' . $x['promphoto2']);
                move_uploaded_file($y['promphoto3f']['tmp_name'], 'public/salon/' . $id . '/' . $x['promphoto3']);
                move_uploaded_file($y['promphoto4f']['tmp_name'], 'public/salon/' . $id . '/' . $x['promphoto4']);
                move_uploaded_file($y['promphoto5f']['tmp_name'], 'public/salon/' . $id . '/' . $x['promphoto5']);
                move_uploaded_file($y['promphoto6f']['tmp_name'], 'public/salon/' . $id . '/' . $x['promphoto6']);
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'promotion'
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

    public function promotioneditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $promotion = $this->getPromotionMapper()->getPromotion1($sub);
        
        $form = new PromotionForm();
        
        $form->bind($promotion);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                
                $this->getPromotionMapper()->savePromotion($promotion);
                if (! file_exists('public/salon/' . $id)) {
                    mkdir('public/salon/' . $id);
                }
                move_uploaded_file($y['promphoto1f']['tmp_name'], 'public/salon/' . $id . '/' . $x['promphoto1']);
                move_uploaded_file($y['promphoto2f']['tmp_name'], 'public/salon/' . $id . '/' . $x['promphoto2']);
                move_uploaded_file($y['promphoto3f']['tmp_name'], 'public/salon/' . $id . '/' . $x['promphoto3']);
                move_uploaded_file($y['promphoto4f']['tmp_name'], 'public/salon/' . $id . '/' . $x['promphoto4']);
                move_uploaded_file($y['promphoto5f']['tmp_name'], 'public/salon/' . $id . '/' . $x['promphoto5']);
                move_uploaded_file($y['promphoto6f']['tmp_name'], 'public/salon/' . $id . '/' . $x['promphoto6']);
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'promotion'
                ));
            }
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form
        );
    }

    public function promotiondeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $promotion = $this->getPromotionMapper()->getPromotion1($sub);
        if (! $promotion) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'promotion'
            ));
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getPromotionMapper()->deletePromotion($sub);
            }
            
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'promotion'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'promotion' => $promotion
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
        
        $form = new CosmetologistForm();
        $cosmetologist = new CosmetologistEntity();
        
        $form->bind($cosmetologist);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
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
                $this->getCosmetologistMapper()->saveCosmetologist($cosunread);
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
        //分院选择
        $salbranches=$this->getSalonMapper()->getSalon($id);
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
        //分院选择
        $salbranches=$this->getSalonMapper()->getSalon($id);
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
    
    // TODO salonlayout
    public function salonlayoutAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $mapper = $this->getSalonlayoutMapper();
        return new ViewModel(array(
            'salonlayouts' => $mapper->getSalonlayout($id),
            'id' => $id
        ));
    }

    public function salonlayoutaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $form = new SalonlayoutForm();
        $salonlayout = new SalonlayoutEntity();
        
        $form->bind($salonlayout);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getSalonlayoutMapper()->saveSalonlayout($salonlayout);
                if (! file_exists('public/salon/' . $id)) {
                    mkdir('public/salon/' . $id);
                }
                move_uploaded_file($y['slphoto1f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto1']);
                move_uploaded_file($y['slphoto2f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto2']);
                move_uploaded_file($y['slphoto3f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto3']);
                move_uploaded_file($y['slphoto4f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto4']);
                move_uploaded_file($y['slphoto5f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto5']);
                move_uploaded_file($y['slphoto6f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto6']);
                move_uploaded_file($y['slphoto7f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto7']);
                move_uploaded_file($y['slphoto8f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto8']);
                move_uploaded_file($y['slphoto9f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto9']);
                move_uploaded_file($y['slphoto10f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto10']);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'salonlayout'
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

    public function salonlayouteditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $salonlayout = $this->getSalonlayoutMapper()->getSalonlayout1($sub);
        
        $form = new SalonlayoutForm();
        
        $form->bind($salonlayout);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                
                $this->getSalonlayoutMapper()->saveSalonlayout($salonlayout);
                if (! file_exists('public/salon/' . $id)) {
                    mkdir('public/salon/' . $id);
                }
                
                move_uploaded_file($y['slphoto1f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto1']);
                move_uploaded_file($y['slphoto2f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto2']);
                move_uploaded_file($y['slphoto3f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto3']);
                move_uploaded_file($y['slphoto4f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto4']);
                move_uploaded_file($y['slphoto5f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto5']);
                move_uploaded_file($y['slphoto6f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto6']);
                move_uploaded_file($y['slphoto7f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto7']);
                move_uploaded_file($y['slphoto8f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto8']);
                move_uploaded_file($y['slphoto9f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto9']);
                move_uploaded_file($y['slphoto10f']['tmp_name'], 'public/salon/' . $id . '/' . $x['slphoto10']);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'salonlayout'
                ));
            }
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form
        );
    }

    public function salonlayoutdeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $salonlayout = $this->getSalonlayoutMapper()->getSalonlayout1($sub);
        if (! $salonlayout) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'salonlayout'
            ));
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getSalonlayoutMapper()->deleteSalonlayout($sub);
            }
            
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'salonlayout'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'salonlayout' => $salonlayout
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
        
        $products = $this->getProductMapper()->getProductedit($id);
        return new ViewModel(array(
            'products' => $products,
            'id' => $id
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
                    array_push($cars,array(
                        "orderid"=>$treatment->getOrderid(),
                        "treid"=>$treatment->getTreid(),
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
                    ));
            }elseif(preg_match("^".$_GET['trestate']."^", $treatment->getTrestate())&&
                preg_match("^".$_GET['prodtitle']."^", $treatment->getProdtitle())
                &&preg_match("^".$_GET['orderid']."^", $treatment->getOrderid())
                &&preg_match("^".$_GET['cusname']."^", $treatment->getCusname())
                &&$gmtclosebegin<=$treatment->getGmtclose()&&$treatment->getGmtclose()<=$gmtclosefinish){
                    array_push($cars,array(
                        "orderid"=>$treatment->getOrderid(),
                        "treid"=>$treatment->getTreid(),
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
                    ));
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
        
        $feedbacks=$this->getFeedbacksMapper()->getTask2($sub);
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form,
            'treatment'=>$treatment,
            'feedbacks'=>$feedbacks
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
    //TODO Stage
    public function stageAction()
    {   
        $container = new Container('salonlogin');
        $id = $container->salnumber;
    
        $mapper = $this->getStageMapper();
        return array(
            'stages' => $mapper->getStage1($id),
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
    // TODO generallayout
    public function generallayoutAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $mapper = $this->getGenerallayoutMapper();
        return new ViewModel(array(
            'generallayouts' => $mapper->getGenerallayout($id),
            'id' => $id
        ));
    }

    public function generallayoutaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $form = new GenerallayoutForm();
        $generallayout = new GenerallayoutEntity();
        
        $form->bind($generallayout);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getGenerallayoutMapper()->saveGenerallayout($generallayout);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'generallayout'
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

    public function generallayouteditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $generallayout = $this->getGenerallayoutMapper()->getGenerallayout1($sub);
        
        $form = new GenerallayoutForm();
        
        $form->bind($generallayout);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                
                $this->getGenerallayoutMapper()->saveGenerallayout($generallayout);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'generallayout'
                ));
            }
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form
        );
    }

    public function generallayoutdeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $generallayout = $this->getGenerallayoutMapper()->getGenerallayout1($sub);
        if (! $generallayout) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'generallayout'
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getGenerallayoutMapper()->deleteGenerallayout($sub);
            }
            
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'generallayout'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'generallayout' => $generallayout
        );
    }
    // TODO prize
    public function prizeAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $mapper = $this->getPrizeMapper();
        return new ViewModel(array(
            'prizes' => $mapper->getPrize($id),
            'id' => $id
        ));
    }

    public function prizeaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $form = new PrizeForm();
        $prize = new PrizeEntity();
        
        $form->bind($prize);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getPrizeMapper()->savePrize($prize);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'prize'
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

    public function prizeeditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $prize = $this->getPrizeMapper()->getPrize1($sub);
        
        $form = new PrizeForm();
        
        $form->bind($prize);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                
                $this->getPrizeMapper()->savePrize($prize);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'prize'
                ));
            }
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form
        );
    }

    public function prizedeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $prize = $this->getPrizeMapper()->getPrize1($sub);
        if (! $prize) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'prize'
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getPrizeMapper()->deletePrize($sub);
            }
            
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'prize'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'prize' => $prize
        );
    }
    // TODO salonslide
    public function salonslideAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $mapper = $this->getSalonslideMapper();
        return new ViewModel(array(
            'salonslides' => $mapper->getSalonslide($id),
            'id' => $id
        ));
    }

    public function salonslideaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $form = new SalonslideForm();
        $salonslide = new SalonslideEntity();
        
        $form->bind($salonslide);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getSalonslideMapper()->saveSalonslide($salonslide);
                if (! file_exists('public/salon/' . $id)) {
                    mkdir('public/salon/' . $id);
                }
                move_uploaded_file($y['ssphoto1f']['tmp_name'], 'public/salon/' . $id . '/' . $x['ssphoto1']);
                move_uploaded_file($y['ssphoto2f']['tmp_name'], 'public/salon/' . $id . '/' . $x['ssphoto2']);
                move_uploaded_file($y['ssphoto3f']['tmp_name'], 'public/salon/' . $id . '/' . $x['ssphoto3']);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'salonslide'
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

    public function salonslideeditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $salonslide = $this->getSalonslideMapper()->getSalonslide1($sub);
        
        $form = new SalonslideForm();
        
        $form->bind($salonslide);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                
                $this->getSalonslideMapper()->saveSalonslide($salonslide);
                if (! file_exists('public/salon/' . $id)) {
                    mkdir('public/salon/' . $id);
                }
                move_uploaded_file($y['ssphoto1f']['tmp_name'], 'public/salon/' . $id . '/' . $x['ssphoto1']);
                move_uploaded_file($y['ssphoto2f']['tmp_name'], 'public/salon/' . $id . '/' . $x['ssphoto2']);
                move_uploaded_file($y['ssphoto3f']['tmp_name'], 'public/salon/' . $id . '/' . $x['ssphoto3']);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'salonslide'
                ));
            }
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form
        );
    }

    public function salonslidedeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $salonslide = $this->getSalonslideMapper()->getSalonslide1($sub);
        if (! $salonslide) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'salonslide'
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getSalonslideMapper()->deleteSalonslide($sub);
            }
            
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'salonslide'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'salonslide' => $salonslide
        );
    }
    
    // TODO salonbutton
    public function salonbuttonAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $mapper = $this->getSalonbuttonMapper();
        return new ViewModel(array(
            'salonbuttons' => $mapper->getSalonbutton($id),
            'id' => $id
        ));
    }

    public function salonbuttonaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $form = new SalonbuttonForm();
        $salonbutton = new SalonbuttonEntity();
        
        $form->bind($salonbutton);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->getSalonbuttonMapper()->saveSalonbutton($salonbutton);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'salonbutton'
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

    public function salonbuttoneditAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = (int) $this->params('sub');
        
        if (! $id) {
            return $this->redirect()->toRoute('cosmeticlogin', array(
                'action' => 'login'
            ));
        }
        $salonbutton = $this->getSalonbuttonMapper()->getSalonbutton1($sub);
        
        $form = new SalonbuttonForm();
        
        $form->bind($salonbutton);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $x = $request->getPost()->toArray();
            $y = $request->getFiles()->toArray();
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $post['salnumber'] = $id;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                
                $this->getSalonbuttonMapper()->saveSalonbutton($salonbutton);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'salonbutton'
                ));
            }
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'form' => $form
        );
    }

    public function salonbuttondeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $salonbutton = $this->getSalonbuttonMapper()->getSalonbutton1($sub);
        if (! $salonbutton) {
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'salonbutton'
            ));
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getSalonbuttonMapper()->deleteSalonbutton($sub);
            }
            
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'salonbutton'
            ));
        }
        
        return array(
            'id' => $id,
            'sub' => $sub,
            'salonbutton' => $salonbutton
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
            'sub' => $this->params('sub')
        ));
    }

    public function pictureaddAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        
        $form = new pictureForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
                $y = $request->getFiles()->toArray();
                if($sub==null){
                foreach ($y['picturefile'] as $picturesrc) {
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
                    foreach ($y['picturefile'] as $picturesrc) {
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
            'form' => $form,
            'id' => $id,
            'sub'=>$sub
        );
    }
    public function picturediraddAction()
    {
        
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $path = iconv('utf-8', 'gbk', $post["dirname"]);
            mkdir('public/salon/'.$id.'/'.$path);
            return $this->redirect()->toRoute('cosmetic', array(
                'action' => 'picture'
            ));
        }
    }
    public function picturedeleteAction()
    {
        $container = new Container('salonlogin');
        $id = $container->salnumber;
        $sub = $this->params('sub');
        $third=$this->params('third');
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
        }else 
        {
            $filename='public/salon/'.$id.'/'.$sub.'/'.$third;
            $path = iconv('utf-8', 'gbk', $filename);
            unlink($path);
            return $this->redirect()->toRoute('cosmetic', array(
                    'action' => 'picture','sub'=>$sub
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
                        "receivestate"=>$lotterycheck->getReceivestate()
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
}