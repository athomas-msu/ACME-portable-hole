<?php
//doctor/module/Reservation/config/module.config.php
 return array(
     'controllers' => array(
         'invokables' => array(
             'Reservation\Controller\Reservation' => 'Reservation\Controller\ReservationController',
         ),
     ),

     'router' => array(
         'routes' => array(
             'reservation' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/reservation[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Reservation\Controller\Reservation',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'reservation' => __DIR__ . '/../view',
         ),
     ),
 );
