<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Salonboss\Controller\Salonboss' => 'Salonboss\Controller\SalonbossController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'salonboss' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/salonboss[/:action[/:sub[/:third]]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Salonboss\Controller',
                        'controller' => 'Salonboss'
                    )
                    
                )
            ),
            'salonbossajax' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/salonbossajax[/:action[/:sub[/:third]]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Salonboss\Controller',
                        'controller' => 'Salonboss',
            
                    ),
                )
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Salonboss' => __DIR__ . '/../view',
        ),
    ),
);
