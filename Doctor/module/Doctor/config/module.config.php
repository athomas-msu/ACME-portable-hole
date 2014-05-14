return array(
     'controllers' => array(
         'invokables' => array(
             'Doctor\Controller\Doctor' => 'Doctor\Controller\DoctorController',
         ),
     ),

     'router' => array(
         'routes' => array(
             'doctor' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/doctor[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Doctor\Controller\Doctor',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'doctor' => __DIR__ . '/../view',
         ),
     ),
 );
