<?php
namespace Cosmetic\Appointment;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Where;
class AppointmentMapper
{
    protected $tableName="appointment";
    protected $dbAdapter;
    protected $sql;
    
    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter=$dbAdapter;
        $this->sql=new Sql($dbAdapter);
        $this->sql->setTable($this->tableName);
       
    }
    

    public function fetchAll()
    {
        $select = $this->sql->select();

        $select->order(array('salnumber ASC', 'salnumber ASC'));
      
        
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $entityPrototype = new AppointmentEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveAppointment(AppointmentEntity $appointment)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($appointment);
    
        if ($appointment->getAppointmentid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('appointmentid' => $appointment->getAppointmentid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['appointmentid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$appointment->getAppointmentid()) {
            $appointment->setAppointmentid($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院所有促销活动
    public function getAppointment($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
        $entityPrototype = new AppointmentEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //取得当前用户
    public function getMyappointments($sub)
    {
        $select = $this->sql->select();
    
        $select->where(array('cusid'=>$sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
        $entityPrototype = new AppointmentEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //取得当前用户最近未过期预约
    public function getAppointmentRecentDate($id,$sub)
    {
        $select = $this->sql->select();
        
        $select->where(array('salnumber='.$id,'cusid='.$sub,'appointmentdate>='.date("Y-m-d")));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
        $entityPrototype = new AppointmentEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //取得当前用户最近一条未过期预约
    public function getAppointmentRecentDate1($id,$sub)
    {
        $select = $this->sql->select();
        $select->order(array('appointmentdate ASC', 'appointmenttime ASC'));
        $select->limit(1);
        $select->where(array('salnumber='.$id,'cusid='.$sub,'timecomparison>='.date("YmdHis")));
        
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
          $hydrator = new ClassMethods();
          $salon = new AppointmentEntity();
          $hydrator->hydrate($results, $salon);
 
          return $salon;
    }
   
    //按日期取得预约,日期为空，选择全部
    public function getAppointmentDate($id,$sub)
    {
        $select = $this->sql->select();
        if ($sub==""){

            $select->where(array('salnumber' => $id));
        }else {
            $select->where(array('salnumber' => $id,'appointmentdate'=>$sub));
        }
        
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
        $entityPrototype = new AppointmentEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //按ID取得单个预约
    public function getAppointment1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('appointmentid' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
          $hydrator = new ClassMethods();
          $salon = new AppointmentEntity();
          $hydrator->hydrate($results, $salon);
 
          return $salon;
    }
    
    //取得此美容师的所有预约
    public function getAppointmentcos($id)
    {
        $select = $this->sql->select();
        $select->where(array('cosid' => $id));
        $select->order(array('appointmentdate DESC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
        $entityPrototype = new AppointmentEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //取得此美容师的所有未过期预约
    public function getAppointmentcos2($id)
    {
        $select = $this->sql->select();
        $select->where(array('cosid' => $id,'timecomparison>'.date("YmdHis",time())));
        $select->order(array('appointmentdate DESC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
        $entityPrototype = new AppointmentEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function deleteAppointment($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('appointmentid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}