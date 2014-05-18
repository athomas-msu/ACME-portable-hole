<?php

namespace Registrant\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Registrant\Model\Registrant;
 use Registrant\Form\RegistrantForm;


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

                 // Redirect to list of registrants
                 return $this->redirect()->toRoute('registrant');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
    {
    }

     public function deleteAction()
    {
    }

    // module/Registrant/src/Registrant/Controller/RegistrantController.php:
    public function getRegistrantTable()
    {
        if (! isset($this->RegistrantTable)) {
            $sm = $this->getServiceLocator();
            $this->RegistrantTable = $sm->get('Registrant\Model\RegistrantTable');
        }
        return $this->RegistrantTable;
    }
}
