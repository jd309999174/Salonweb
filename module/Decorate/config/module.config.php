<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Decorate\Controller\Dec' => 'Decorate\Controller\DecController'
        )
    ),
    'router' => array(
        'routes' => array(
            'decorate' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/decorate[/:action[/:sub[/:third]]]',
                    
                    'defaults' => array(
                        '__NAMESPACE__' => 'Decorate\Controller',
                        'controller' => 'Dec',
                        'action' => 'index'
                    ),
//                     'constraints' => array(
//                         'action' => '(productlist|templatetest|templatehome|index|login|index1|index2|foo|ajaxtest)'
                        
//                     )
                )
            ),
            'decorateajax' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/decorateajax[/:action[/:sub[/:third]]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Decorate\Controller',
                        'controller' => 'Dec',
                        
                    ),
                )
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Decorate' => __DIR__ . '/../view'
        )
    )
);
