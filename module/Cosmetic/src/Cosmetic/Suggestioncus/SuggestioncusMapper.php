<?php
namespace Cosmetic\Suggestioncus;

use Zend\Db\Adapter\Adapter;
use Cosmetic\Suggestioncus\SuggestioncusEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;

class SuggestioncusMapper
{
    protected $tableName = 'suggestioncus';
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

        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $entityPrototype = new SuggestioncusEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
public function saveTask(SuggestioncusEntity $task)
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
 
 //按美容院获取所有建议
 public function getSugestionsal($id)
 {
     $select = $this->sql->select();
     $select->order(array('datetime DESC'));
     $select->where(array('salnumber' => $id));
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     
     $entityPrototype = new SuggestioncusEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //按用户获取所有建议
 public function getSugestioncus($id)
 {
     $select = $this->sql->select();
     $select->order(array('datetime DESC'));
     $select->where(array('cusid' => $id));
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     
     $entityPrototype = new SuggestioncusEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //按id获取活动
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
     $task = new SuggestioncusEntity();
     $hydrator->hydrate($result, $task);
 
     return $task;
 }
 

 
 
 public function deleteTask($id)
 {
     $delete = $this->sql->delete();
     $delete->where(array('id' => $id));
 
     $statement = $this->sql->prepareStatementForSqlObject($delete);
     return $statement->execute();
 }

}