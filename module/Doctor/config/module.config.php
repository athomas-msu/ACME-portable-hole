 return array(
     'controllers' => array(
         'invokables' => array(
             'Doctor\Controller\Doctor' => 'Doctor\Controller\DoctorController',
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'album' => __DIR__ . '/../view',
         ),
     ),
 );
