<?php
namespace Cosmetic\Signup;

use Zend\Db\Adapter\Adapter;
use Cosmetic\Signup\SignupEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;

class SignupMapper
{
    protected $tableName = 'signup';
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

        $entityPrototype = new SignupEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //获取顾客已参加的活动
    public function getCusActivities($id)
    {
        $select = $this->sql->select();
        $select->order(array('signupdate DESC'));
        $select->where(array('cusid' => $id));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
    
        $entityPrototype = new SignupEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
public function saveTask(SignupEntity $task)
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
     $task = new SignupEntity();
     $hydrator->hydrate($result, $task);
 
     return $task;
 }
 //按用户id和页面id获取
 public function getTask1($cusid,$pageid)
 {
     $select = $this->sql->select();
     $select->where(array('cusid' => $cusid,'pageid'=>$pageid));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $result = $statement->execute()->current();
     if (!$result) {
         return null;
     }
 
     $hydrator = new ClassMethods();
     $task = new SignupEntity();
     $hydrator->hydrate($result, $task);
 
     return $task;
 }
 //按pageid获取活动
 public function getActivityregister($id)
 {
     $select = $this->sql->select();
     $select->order(array('signupdate DESC'));
     $select->where(array('pageid' => $id));
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
 
     $entityPrototype = new SignupEntity();
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
 //按用户id，活动页id删除
 public function deleteTask1($cusid,$pageid)
 {
     $delete = $this->sql->delete();
     $delete->where(array('cusid' => $cusid,'pageid'=>$pageid));
 
     $statement = $this->sql->prepareStatementForSqlObject($delete);
     return $statement->execute();
 }
}