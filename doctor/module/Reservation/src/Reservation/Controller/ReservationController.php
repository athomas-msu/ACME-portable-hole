<<<<<<< HEAD
<?php

namespace Reservation\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Reservation\Model\Reservation;
 use Reservation\Form\ReservationForm;


class ReservationController extends AbstractActionController
{
    protected $reservationTable;

     public function indexAction()
    {
        return new ViewModel(array(
            'reservations' => $this->getReservationTable()->fetchAll(),
        ));
    }

     public function addAction()
    {
         $form = new ReservationForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $reservation = new Reservation();
             $form->setInputFilter($reservation->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $reservation->exchangeArray($form->getData());
                 $this->getReservationTable()->saveReservation($reservation);

                 // Redirect to list of reservations
                 return $this->redirect()->toRoute('reservation');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
    {
        $res = $this->params()->fromRoute('res');
        return $this->getReservationTable()->saveReservation($res);
    }

     public function deleteAction()
    {
    }

    public function countAvailableAction()
    {
        $registrantID = $this->params()->fromRoute('registrantID');
        return $this->getReservationTable()->getAvailableCount($registrantID);
    }

    public function availableAction()
    {
        return $this->getReservationTable()->getAvailableReservation();
    }

    // module/Reservation/src/Reservation/Controller/ReservationController.php:
    public function getReservationTable()
    {
        if (! isset($this->ReservationTable)) {
            $sm = $this->getServiceLocator();
            $this->ReservationTable = $sm->get('Reservation\Model\ReservationTable');
        }
        return $this->ReservationTable;
    }
}
=======
<?php

namespace Reservation\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Reservation\Model\Reservation;
 use Reservation\Form\ReservationForm;


class ReservationController extends AbstractActionController
{
    protected $reservationTable;

     public function indexAction()
    {
        return new ViewModel(array(
            'reservations' => $this->getReservationTable()->fetchAll(),
        ));
    }

     public function addAction()
    {
         $form = new ReservationForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $reservation = new Reservation();
             $form->setInputFilter($reservation->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $reservation->exchangeArray($form->getData());
                 $this->getReservationTable()->saveReservation($reservation);

                 // Redirect to list of reservations
                 return $this->redirect()->toRoute('reservation');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
    {
        $res = $this->params()->fromRoute('res');
        return $this->getReservationTable()->saveReservation($res);
    }

     public function deleteAction()
    {
    }

    public function countAvailableAction()
    {
        $registrantID = $this->params()->fromRoute('registrantID');
        return $this->getReservationTable()->getAvailableCount($registrantID);
    }

    public function availableAction()
    {
        return $this->getReservationTable()->getAvailableReservation();
    }

    // module/Reservation/src/Reservation/Controller/ReservationController.php:
    public function getReservationTable()
    {
        if (! isset($this->ReservationTable)) {
            $sm = $this->getServiceLocator();
            $this->ReservationTable = $sm->get('Reservation\Model\ReservationTable');
        }
        return $this->ReservationTable;
    }
}
>>>>>>> a9744b07b8ad46e00e572035284d32968a590ab4
