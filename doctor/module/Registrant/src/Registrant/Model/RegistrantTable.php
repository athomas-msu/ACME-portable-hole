<?php
namespace Registrant\Model;

 use Zend\Db\TableGateway\TableGateway;

 class RegistrantTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getRegistrant($id)
     {
         //$id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveRegistrant(Registrant $Registrant)
     {
         $data = array(
             'id' => $_SESSION['Registrant\Controller']['registrantId'],
             'name' => $Registrant->name,
             'email'  => $Registrant->email,
         );

         $id = $Registrant->id;
         if (strlen($id) == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getRegistrant($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Registrant id does not exist');
             }
         }
     }

     public function deleteRegistrant($id)
     {
         $this->tableGateway->delete(array('id' => $id));
     }
 }