<?php
namespace Cosmetic\Tip;

use Zend\Db\Adapter\Adapter;
use Cosmetic\Tip\TipEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;

class TipMapper
{
    protected $tableName = 'tippay';
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
        $select->order(array('gmtclose DESC'));

        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $entityPrototype = new TipEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
public function saveTask(TipEntity $task)
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
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $result = $statement->execute()->current();
     if (!$result) {
         return null;
     }
 
     $hydrator = new ClassMethods();
     $task = new TipEntity();
     $hydrator->hydrate($result, $task);
 
     return $task;
 }
 
 //顾客全部打赏
 public function getTask1($cusid)
 {
     $select = $this->sql->select();
     $select->where(array('cusid' => $cusid,'tipstate'=>'paid'));
     $select->order(array('gmtclose DESC'));
     
     
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     
     $entityPrototype = new TipEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 
 //美容师全部打赏
 public function getTask2($cosid)
 {
     $select = $this->sql->select();
     $select->where(array('cosid' => $cosid,'tipstate'=>'paid'));
     $select->order(array('gmtclose DESC'));
     
     
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     
     $entityPrototype = new TipEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 
 //美容院全部打赏
 public function getTask3($salnumber)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => $salnumber,'tipstate'=>'paid'));
     $select->order(array('gmtclose DESC'));
     
     
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     
     $entityPrototype = new TipEntity();
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