<?php
//doctor/module/Registrant/config/module.config.php
 return array(
     'controllers' => array(
         'invokables' => array(
             'Registrant\Controller\Registrant' => 'Registrant\Controller\RegistrantController',
         ),
     ),

     'router' => array(
         'routes' => array(
             'registrant' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/registrant[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Registrant\Controller\Registrant',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'registrant' => __DIR__ . '/../view',
         ),
     ),
 );
