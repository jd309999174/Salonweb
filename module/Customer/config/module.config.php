<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Customer\Controller\Cus' => 'Customer\Controller\CusController'
        )
    ),
    'router' => array(
        'routes' => array(
            'customer' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/customer[/:action[/:sub[/:third]]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Cus',
                        'action' => 'homepage'
                    ),
                    
                )
            ),
            'customerajax' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/customerajax[/:action[/:sub[/:third]]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller' => 'Cus',
                        
                    ),
                )
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Customer' => __DIR__ . '/../view'
        )
    )
);
