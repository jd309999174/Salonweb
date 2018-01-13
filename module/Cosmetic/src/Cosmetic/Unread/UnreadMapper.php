<?php
namespace Cosmetic\Unread;

use Zend\Db\Adapter\Adapter;
use Cosmetic\Unread\UnreadEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;

class UnreadMapper
{
    protected $tableName = 'unread';
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

        $entityPrototype = new UnreadEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
public function saveTask(UnreadEntity $task)
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
 
 //按发送方和接收方查询
 public function getTask($sendid,$receiveid)
 {
     $select = $this->sql->select();
     $select->where(array('sendid' => $sendid,'receiveid'=>$receiveid));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $result = $statement->execute()->current();
     if (!$result) {
         return null;
     }
 
     $hydrator = new ClassMethods();
     $task = new UnreadEntity();
     $hydrator->hydrate($result, $task);
 
     return $task;
 }
 
 
 //按接收方查询
 public function getTask1($receiveid)
 {
     $select = $this->sql->select();
     $select->where(array('receiveid'=>$receiveid));
     
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     
     $entityPrototype = new UnreadEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 
 //android直接用的mysql,此为ios的json而做
 public function getUnreadmessage($receiveid)
 {
     $select = $this->sql->select();
     $select->where(array('receiveid'=>$receiveid,'number>0'));
      
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
      
     $entityPrototype = new UnreadEntity();
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