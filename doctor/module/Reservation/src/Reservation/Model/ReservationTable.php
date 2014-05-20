<<<<<<< HEAD
<?php
namespace Reservation\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Select;

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
        $select = new Select();
        /*
        $sql = 'SELECT COUNT(ID) FROM Reservation WHERE ' .
           'registrant_id = :registrantId';

        $stmt = new Zend_Db_Statement_Mysqli($db, $sql);

        $stmt->execute(array(':registrant_id' => $registrantId));
        $row = $stmt->fetch();
        echo print_r($row);
        */
        $select = $this->tableGateway->select(function (Select $select) {
            $select->from(array('cnt' => 'COUNT(ID)'));
            $select->where->('registrant_id = "',$registrantId);
            });
        $rowset = $db->query($select)
        $row = $rowset->current();
        return $row->cnt;
    }


    public function getAvailableReservation()
    {
        $rowset = $this->tableGateway->select(array('registrant_id' => ""));
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
            'id' => uniqid(),
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
=======
<?php
namespace Reservation\Model;

 use Zend\Db\TableGateway\TableGateway;

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
        $rowset = $this->tableGateway->select(array(
            'id' => new \Zend\Db\Sql\Expression('COUNT(*)'),
            'registrant_id' => $registrantId
            ));
        $row = $rowset->current();
        return $row->num;
    }


    public function getAvailableReservation()
    {
        $rowset = $this->tableGateway->select(array('registrant_id' => ""));
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
            'id' => uniqid(),
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
>>>>>>> a9744b07b8ad46e00e572035284d32968a590ab4
