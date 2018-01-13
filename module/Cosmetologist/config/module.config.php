<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Cosmetologist\Controller\Cos2' => 'Cosmetologist\Controller\Cos2Controller',
        ),
    ),
     'router' => array(
        'routes' => array(
            'cosmetologist' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/cosmetologist[/:action[/:sub[/:third]]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cosmetologist\Controller',
                        'controller' => 'Cos2',
                        'action' => 'index'
                    ),
                    
                )
            ),
            'cosmetologistajax' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/cosmetologistajax[/:action[/:sub[/:third]]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cosmetologist\Controller',
                        'controller' => 'Cos2',
                        
                    ),
                )
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Cosmetologist' => __DIR__ . '/../view',
        ),
    ),
);
