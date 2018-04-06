<?php
namespace Cosmetic\Notificationinfo;

use Zend\Db\Adapter\Adapter;
use Cosmetic\Notificationinfo\NotificationinfoEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;

class NotificationinfoMapper
{
    protected $tableName = 'notificationinfo';
    protected $dbAdapter;
    protected $sql;

    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        $this->sql = new Sql($dbAdapter);
        $this->sql->setTable($this->tableName);
    }

    public function fetchAll()
    {
        $select = $this->sql->select();
        //$select->order(array('completed ASC', 'created ASC'));

        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $entityPrototype = new NotificationinfoEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
public function saveTask(NotificationinfoEntity $task)
 {
     $hydrator = new ClassMethods();
     $data = $hydrator->extract($task);

     if ($task->getId()) {
         // update action
         $action = $this->sql->update();
         $action->set($data);
         $action->where(array('id' => $task->getId()));
     } else {
         // insert action
         $action = $this->sql->insert();
         unset($data['id']);
         $action->values($data);
     }
     $statement = $this->sql->prepareStatementForSqlObject($action);
     $result = $statement->execute();

     if (!$task->getId()) {
         $task->setId($result->getGeneratedValue());
     }
     return $result;

 }
 
 public function getTask($id)
 {
     $select = $this->sql->select();
     $select->where(array('id' => $id));
     $select->order('id DESC');
     
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $result = $statement->execute()->current();
     if (!$result) {
         return null;
     }
 
     $hydrator = new ClassMethods();
     $task = new NotificationinfoEntity();
     $hydrator->hydrate($result, $task);
 
     return $task;
 }
 
 //获取此美容院的所有通知
 public function getTask1($salnumber)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => $salnumber));
     $select->order(array('id DESC'));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
 
     $entityPrototype = new NotificationinfoEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 
 //获取此美容院今天一个通知
 public function getTask2($salnumber)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => $salnumber,'nodate'=>date('Y-m-d')));
     $select->limit(1);
     $select->order(array('id DESC'));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $result = $statement->execute()->current();
     if (!$result) {
         return null;
     }
 
     $hydrator = new ClassMethods();
     $task = new NotificationinfoEntity();
     $hydrator->hydrate($result, $task);
 
     return $task;
 }

 //获取此美容院的所有通知
 public function getAllnotificationtoday($salnumber)
 {
     $comparedate=date('Ymd',strtotime("-7 Days"));
     $select = $this->sql->select();
     $select->where(array('salnumber' => $salnumber,'comparenodate>='.$comparedate));
     $select->order(array('nodate ASC'));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
 
     $entityPrototype = new NotificationinfoEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }

 
 public function deleteTask($id)
 {
     $delete = $this->sql->delete();
     $delete->where(array('id' => $id));
 
     $statement = $this->sql->prepareStatementForSqlObject($delete);
     return $statement->execute();
 }
}