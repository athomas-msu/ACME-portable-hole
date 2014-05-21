<<<<<<< HEAD
<?php

namespace Registrant\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Zend\Session\Container;
 use Registrant\Model\Registrant;
 use Registrant\Form\RegistrantForm;
 use Reservation\Model\Reservation;
 use Reservation\Controller\ReservationController;


class RegistrantController extends AbstractActionController
{
    protected $registrantTable;

     public function indexAction()
    {
        return new ViewModel(array(
            'registrants' => $this->getRegistrantTable()->fetchAll(),
        ));
    }

     public function addAction()
    {
         $form = new RegistrantForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $registrant = new Registrant();
             $form->setInputFilter($registrant->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $registrant->exchangeArray($form->getData());
                 $this->getRegistrantTable()->saveRegistrant($registrant);

                $currentRegistrant = $_SESSION['Registrant\Controller']['registrantId'];

                 for ($i = 1; $i <= (int)$form->get('tickets')->getValue(); $i++) {
                    $resAvailable = $this->forward()->dispatch('Reservation\Controller\Reservation', array('action' => 'available'));
                    $resAvailable->registrant_id = $currentRegistrant;
                    $resAvailable->status = "R";
                    $this->forward()->dispatch('Reservation\Controller\Reservation', array(
                        'action' => 'edit',
                        'res' => $resAvailable));
echo print_r($this->forward()->dispatch('Reservation\Controller\Reservation', array(
    'action' => 'countAvailable',
    'registrantID' => $currentRegistrant)));
                 }
                 // Redirect to list of registrants
                 //return $this->redirect()->toRoute('thankyou');
             }
         }
         return array('form' => $form);
     }

    public function editAction() {}
     public function thankyouAction()
    {

         $id =  $this->params()->fromRoute('id', 0);

        //if (!$id) {
         //   return $this->redirect()->toRoute('registrant', array('action' => 'index'));
            //echo print_r($this->session);
            //echo $application->session->offsetExists('email');
             //echo "|" . print_r($this->params()->fromRoute()) . "|";
             return $id;
         //}

         // Get the Registrant with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $registrant = $this->getRegistrantTable()->getRegistrant($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('registrant', array(
                 'action' => 'index'
             ));
         }

         $form  = new RegistrantForm();
         $form->bind($registrant);
         $form->get('submit')->setAttribute('value', 'ThankYou');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($registrant->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getRegistrantTable()->saveRegistrant($registrant);

                 // Redirect to list of registrants
                 return $this->redirect()->toRoute('thankyou');
             }
         }
         return array(
             'id' => $id,
             'form' => $form,
         );
     }


     public function deleteAction()
    {
    }

    // module/Registrant/src/Registrant/Controller/RegistrantController.php:
    public function getRegistrantTable()
    {
        if (! isset($this->RegistrantTable)) {
            $session = new Container(__NAMESPACE__);
            $session->registrantId = uniqid();
            $sm = $this->getServiceLocator();
            $this->RegistrantTable = $sm->get('Registrant\Model\RegistrantTable');
        }
        return $this->RegistrantTable;
    }
}
=======
<?php

namespace Registrant\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Zend\Session\Container;
 use Registrant\Model\Registrant;
 use Registrant\Form\RegistrantForm;
 use Reservation\Model\Reservation;
 use Reservation\Controller\ReservationController;


class RegistrantController extends AbstractActionController
{
    protected $registrantTable;

     public function indexAction()
    {
        return new ViewModel(array(
            'registrants' => $this->getRegistrantTable()->fetchAll(),
        ));
    }

     public function addAction()
    {
         $form = new RegistrantForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $registrant = new Registrant();
             $form->setInputFilter($registrant->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $registrant->exchangeArray($form->getData());
                 $this->getRegistrantTable()->saveRegistrant($registrant);

                $currentRegistrant = $_SESSION['Registrant\Controller']['registrantId'];

                 for ($i = 1; $i <= (int)$form->get('tickets')->getValue(); $i++) {
                    $resAvailable = $this->forward()->dispatch('Reservation\Controller\Reservation', array('action' => 'available'));
                    $resAvailable->registrant_id = $currentRegistrant;
                    $resAvailable->status = "R";
                    $this->forward()->dispatch('Reservation\Controller\Reservation', array(
                        'action' => 'edit',
                        'res' => $resAvailable));
echo print_r($this->forward()->dispatch('Reservation\Controller\Reservation', array(
    'action' => 'countAvailable',
    'registrantID' => $currentRegistrant)));
                 }
                 // Redirect to list of registrants
                 //return $this->redirect()->toRoute('thankyou');
             }
         }
         return array('form' => $form);
     }

    public function editAction() {}
     public function thankyouAction()
    {

         $id =  $this->params()->fromRoute('id', 0);

        //if (!$id) {
         //   return $this->redirect()->toRoute('registrant', array('action' => 'index'));
            //echo print_r($this->session);
            //echo $application->session->offsetExists('email');
             //echo "|" . print_r($this->params()->fromRoute()) . "|";
             return $id;
         //}

         // Get the Registrant with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $registrant = $this->getRegistrantTable()->getRegistrant($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('registrant', array(
                 'action' => 'index'
             ));
         }

         $form  = new RegistrantForm();
         $form->bind($registrant);
         $form->get('submit')->setAttribute('value', 'ThankYou');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($registrant->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getRegistrantTable()->saveRegistrant($registrant);

                 // Redirect to list of registrants
                 return $this->redirect()->toRoute('thankyou');
             }
         }
         return array(
             'id' => $id,
             'form' => $form,
         );
     }


     public function deleteAction()
    {
    }

    // module/Registrant/src/Registrant/Controller/RegistrantController.php:
    public function getRegistrantTable()
    {
        if (! isset($this->RegistrantTable)) {
            $session = new Container(__NAMESPACE__);
            $session->registrantId = uniqid();
            $sm = $this->getServiceLocator();
            $this->RegistrantTable = $sm->get('Registrant\Model\RegistrantTable');
        }
        return $this->RegistrantTable;
    }
}
>>>>>>> a9744b07b8ad46e00e572035284d32968a590ab4
