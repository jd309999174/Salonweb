<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Cosmetic\Controller\Cos' => 'Cosmetic\Controller\CosController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Cosmetic\Controller\Cos',
                        'action'     => 'personalweb',
                    ),
                ),
            ),
            'cosmetic' => array(
             'type'    => 'Segment',
             'options' => array(
                 'route'    => '/cosmetic[/:action[/:sub[/:third]]]', 
                 //salon中，id是salnumber,sub是salbranch
                 'defaults' => array(
                     '__NAMESPACE__' => 'Cosmetic\Controller',
                     'controller'    => 'Cos',
                     'action'        => 'login',
                 ),
                
             ),
         ),
            'cosmeticajax' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/cosmeticajax[/:action[/:sub]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cosmetic\Controller',
                        'controller' => 'Cos'
                    ), 
                )
            ),
            'cosmeticlogin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/cosmeticlogin[/:action[/:sub]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cosmetic\Controller',
                        'controller' => 'Cos'
                    ),
                )
            )
//             'ui' => array(
//                 'type'    => 'Segment',
//                 'options' => array(
//                     'route'    => '/ui[/:action[/:sub]]',
                 
//                     'defaults' => array(
//                         '__NAMESPACE__' => 'Cosmetic\Controller',
//                         'controller'    => 'Ui',
//                         'action'        => 'login',
//                     ),
//                     'constraints' => array(
//                         'action' => '(|productlist|test|index|login|index1|index2|index3)',
//                         'sub'    => '[a-zA-Z][a-zA-Z0-9_-]*',
//                     ),
//                 ),
//             ),
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'Cosmetic/layout/cosmetic' => __DIR__ . '/../view/layout/cosmetic.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml'
        ),
        'template_path_stack' => array(
            'Cosmetic' => __DIR__ . '/../view',
        ),
    ),
    
);
