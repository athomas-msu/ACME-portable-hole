<?php
namespace Reservation\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Expression;

 class ReservationTable
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

    public function getAvailableCount($registrantId)
    {
        return $this->getRegistrant($registrantId)->count();
    }

     public function getRegistrant($id)
     {
         //$id  = (int) $id;
         $rowset = $this->tableGateway->select(array('registrant_id' => $id));
         //$row = $rowset->current();
         if (!$rowset) {
             throw new \Exception("Could not find registrant $id");
         }
         return $rowset;
     }

    public function getAvailableReservation()
    {
        $rowset = $this->tableGateway->select(array('registrant_id' => ''));
        $row = $rowset->current();
        return $row;
    }

     public function getReservation($id)
     {
         //$id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveReservation(Reservation $Reservation)
     {
         $data = array(
             'status' => $Reservation->status,
             'registrant_id'  => $Reservation->registrant_id,
         );

         $id = $Reservation->id;
         if (strlen($id) == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getReservation($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Reservation id does not exist');
             }
         }
     }

     public function deleteReservation($id)
     {
         $this->tableGateway->delete(array('id' => $id));
     }
 }
