<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Checklist\Controller\Task' => 'Checklist\Controller\TaskController',
            'Checklist\Controller\Task1' => 'Checklist\Controller\Task1Controller',
        ),
    ),
     'router' => array(
     'routes' => array(
         'task1' => array(
             'type'    => 'Segment',
             'options' => array(
                 'route'    => '/task[/:action[/:id]]',
                 'defaults' => array(
                     '__NAMESPACE__' => 'Checklist\Controller',
                     'controller'    => 'Task',
                     'action'        => 'index',
                 ),
                 'constraints' => array(
                     'action' => '(add|edit|delete|database)',
                     'id'     => '[0-9]+',
                 ),
             ),
         ),
         'nihao' => array(
             'type'    => 'Literal',
             'options' => array(
                 'route'    => '/task1',
                 'defaults' => array(
                     '__NAMESPACE__' => 'Checklist\Controller',
                     'controller'    => 'Task1',
                     'action'        => 'index',
                 ),
             ),
         ),
     ),
 ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Checklist' => __DIR__ . '/../view',
        ),
    ),
);
