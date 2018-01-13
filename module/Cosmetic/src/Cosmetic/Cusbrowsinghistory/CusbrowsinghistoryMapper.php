<?php
namespace Cosmetic\Cusbrowsinghistory;

use Zend\Db\Adapter\Adapter;
use Cosmetic\Cusbrowsinghistory\CusbrowsinghistoryEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Where;

class CusbrowsinghistoryMapper
{
    protected $tableName = 'cusbrowsinghistory';
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
        $select->order(array('completed ASC', 'created ASC'));

        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $entityPrototype = new CusbrowsinghistoryEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
public function saveTask(CusbrowsinghistoryEntity $task)
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
     $task = new CusbrowsinghistoryEntity();
     $hydrator->hydrate($result, $task);
 
     return $task;
 }
 
 
 public function getCusbrowsingperson($id)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => $id));
     $select->group('cusname');
     
     
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
   
     $entityPrototype = new CusbrowsinghistoryEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 
 //按日期获取和美容院id获取
 public function getCusbrowsingongmtcusdate($id,$minValue,$maxValue)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => $id));
     //$select->order(array('salid ASC', 'salnumber ASC'));
     $select->group('cusname');
     $where=new Where();
     $where->between('gmtcusdate', $minValue, $maxValue);
     $select->where($where);
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     if (!$results) {
         return null;
     }
 
 
     $entityPrototype = new CusbrowsinghistoryEntity();
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