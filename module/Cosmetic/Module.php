<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Cosmetic for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Cosmetic;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Cosmetic\Salon\SalonMapper;
use Cosmetic\Promotion\PromotionMapper;
use Cosmetic\Cosmetologist\CosmetologistMapper;
use Cosmetic\Customer\CustomerMapper;
use Cosmetic\Detail\DetailMapper;
use Cosmetic\Notification\NotificationMapper;
use Cosmetic\Product\ProductMapper;
use Cosmetic\Raffle\RaffleMapper;
use Cosmetic\Stage\StageMapper;
use Cosmetic\Subbranch\SubbranchMapper;
use Cosmetic\Name\NameMapper;
use Cosmetic\Treatment\TreatmentMapper;
use Cosmetic\Salonlayout\SalonlayoutMapper;
use Cosmetic\Appointment\AppointmentMapper;
use Cosmetic\Generallayout\GenerallayoutMapper;
use Cosmetic\Prize\PrizeMapper;
use Cosmetic\Salonslide\SalonslideMapper;
use Cosmetic\Salonbutton\SalonbuttonMapper;
use Cosmetic\Saloncouponissue\SaloncouponissueMapper;
use Cosmetic\Saloncouponget\SaloncoupongetMapper;
use Cosmetic\Picture\PictureMapper;
use Cosmetic\Page\PageMapper;
use Decorate\Template\TemplateMapper;
use Cosmetic\Demandclassifyseries\DemandclassifyseriesMapper;
use Cosmetic\Account\AccountMapper;
use Cosmetic\Productcombination\ProductcombinationMapper;
use Cosmetic\Trolley\TrolleyMapper;
use Cosmetic\Custombutton\CustombuttonMapper;
use Cosmetic\Chatmodule\ChatmoduleMapper;
use Cosmetic\Feedbacks\FeedbacksMapper;
use Cosmetic\Unread\UnreadMapper;
use Cosmetic\Signup\SignupMapper;
use Cosmetic\Notificationinfo\NotificationinfoMapper;
use Cosmetic\Cusleveltype\CusleveltypeMapper;
use Cosmetic\Cusbrowsinghistory\CusbrowsinghistoryMapper;
use Cosmetic\Lottery\LotteryMapper;
use Cosmetic\Tip\TipMapper;

class Module implements AutoloaderProviderInterface
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'TipMapper' => function ($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $Tipmapper = new TipMapper($dbAdapter);
                return $Tipmapper;
                },
                'CusbrowsinghistoryMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Cusbrowsinghistorymapper = new CusbrowsinghistoryMapper($dbAdapter);
                    return $Cusbrowsinghistorymapper;
                },
                'LotteryMapper' => function ($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $Lotterymapper = new LotteryMapper($dbAdapter);
                return $Lotterymapper;
                },
                'CusleveltypeMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Cusleveltypemapper = new CusleveltypeMapper($dbAdapter);
                    return $Cusleveltypemapper;
                },
                'ProductcombinationMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Productcombinationmapper = new ProductcombinationMapper($dbAdapter);
                    return $Productcombinationmapper;
                },
                'NotificationinfoMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Notificationinfomapper = new NotificationinfoMapper($dbAdapter);
                    return $Notificationinfomapper;
                },
                'UnreadMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Unreadmapper = new UnreadMapper($dbAdapter);
                    return $Unreadmapper;
                },
                'SignupMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Signupmapper = new SignupMapper($dbAdapter);
                    return $Signupmapper;
                },
                'FeedbacksMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $FeedbacksMapper = new FeedbacksMapper($dbAdapter);
                    return $FeedbacksMapper;
                },
                'AccountMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Accountmapper = new AccountMapper($dbAdapter);
                    return $Accountmapper;
                },
                'ChatmoduleMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Chatmodulemapper = new ChatmoduleMapper($dbAdapter);
                    return $Chatmodulemapper;
                },
                'CustombuttonMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Custombuttonmapper = new CustombuttonMapper($dbAdapter);
                    return $Custombuttonmapper;
                },
                'TemplateMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Templatemapper = new TemplateMapper($dbAdapter);
                    return $Templatemapper;
                },
                'DemandclassifyseriesMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $DemandclassifyseriesMapper = new DemandclassifyseriesMapper($dbAdapter);
                    return $DemandclassifyseriesMapper;
                },
                'SalonMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Salonmapper = new SalonMapper($dbAdapter);
                    return $Salonmapper;
                },
                'PageMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Pagemapper = new PageMapper($dbAdapter);
                    return $Pagemapper;
                },
                'PictureMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Picturemapper = new PictureMapper($dbAdapter);
                    return $Picturemapper;
                },
                'SaloncouponissueMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Saloncouponissuemapper = new SaloncouponissueMapper($dbAdapter);
                    return $Saloncouponissuemapper;
                },
                'SaloncoupongetMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Saloncoupongetmapper = new SaloncoupongetMapper($dbAdapter);
                    return $Saloncoupongetmapper;
                },
                'SalonbuttonMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Salonbuttonmapper = new SalonbuttonMapper($dbAdapter);
                    return $Salonbuttonmapper;
                },
                'SalonslideMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Salonslidemapper = new SalonslideMapper($dbAdapter);
                    return $Salonslidemapper;
                },
                'PrizeMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Prizemapper = new PrizeMapper($dbAdapter);
                    return $Prizemapper;
                },
                'DetailMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Detailmapper = new DetailMapper($dbAdapter);
                    return $Detailmapper;
                },
                'GenerallayoutMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $generallayout = new GenerallayoutMapper($dbAdapter);
                    return $generallayout;
                },
                'AppointmentMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Appointment = new AppointmentMapper($dbAdapter);
                    return $Appointment;
                },
                'SalonlayoutMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Salonlayoutmapper = new SalonlayoutMapper($dbAdapter);
                    return $Salonlayoutmapper;
                },
                'PromotionMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Promotionmapper = new PromotionMapper($dbAdapter);
                    return $Promotionmapper;
                },
                'CosmetologistMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Cosmetologistmapper = new CosmetologistMapper($dbAdapter);
                    return $Cosmetologistmapper;
                },
                'CustomerMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Customermapper = new CustomerMapper($dbAdapter);
                    return $Customermapper;
                },
                'NotificationMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Notificationmapper = new NotificationMapper($dbAdapter);
                    return $Notificationmapper;
                },
                'ProductMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Productmapper = new ProductMapper($dbAdapter);
                    return $Productmapper;
                },
                
                'RaffleMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Rafflemapper = new RaffleMapper($dbAdapter);
                    return $Rafflemapper;
                },
                'StageMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Stagemapper = new StageMapper($dbAdapter);
                    return $Stagemapper;
                },
                'SubbranchMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Subbranchmapper = new SubbranchMapper($dbAdapter);
                    return $Subbranchmapper;
                },
                'TreatmentMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Treatmentmapper = new TreatmentMapper($dbAdapter);
                    return $Treatmentmapper;
                },
                'NameMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Namemapper = new NameMapper($dbAdapter);
                    return $Namemapper;
                },
                'TrolleyMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $Trolleymapper = new TrolleyMapper($dbAdapter);
                    return $Trolleymapper;
                }
            )
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__)
                )
            )
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $eventManager->attach(MvcEvent::EVENT_ROUTE, array(
            $this,
            'onRoute'
        ), - 9000);
    }

    public function onRoute(MvcEvent $e)
    {
        $route = $e->getRouteMatch()->getMatchedRouteName();
        if ($route == 'cosmetic') // 后台
            $e->getViewModel()->setTemplate("layout/cosmetic");
        else 
            if ($route == 'cosmeticajax'  || $route == "home") // 装修
                $e->getViewModel()->setTemplate("layout/ajaxsource");
            else 
                if ($route == 'cosmeticlogin') // 装修
                    $e->getViewModel()->setTemplate("layout/cosmeticlogin");
                    else
                if ($route == 'customer') // 前台
                    $e->getViewModel()->setTemplate("layout/customer");
                else 
                    if ($route == 'customerajax') // 前台
                        $e->getViewModel()->setTemplate("layout/ajaxsource");
                    else 
                        if ($route == 'decorate') // 装修
                            $e->getViewModel()->setTemplate("layout/decorate");
                        else 
                            if ($route == 'cosmetologist') // 装修
                                $e->getViewModel()->setTemplate("layout/cosmetologist");
                            else 
                                if ($route == 'cosmetologistajax') //
                                    $e->getViewModel()->setTemplate("layout/ajaxsource");
                                    else
                                        if ($route == 'salonboss') //美容院老板
                                        $e->getViewModel()->setTemplate("layout/salonboss");
                                        else
                                            if ($route == 'salonbossajax') //美容院老板
                                            $e->getViewModel()->setTemplate("layout/salonbossajax");
    }
}

