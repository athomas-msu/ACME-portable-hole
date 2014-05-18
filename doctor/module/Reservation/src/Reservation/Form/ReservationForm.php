<?php 
namespace Reservation\Form;

 use Zend\Form\Form;

 class ReservationForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('Reservation');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'status',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Status',
             ),
         ));
         $this->add(array(
             'name' => 'registrant_id',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Registrant ID',
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }
