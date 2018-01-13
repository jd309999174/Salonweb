<?php
namespace Cosmetic\Chatmodule;

use Zend\Db\Adapter\Adapter;
use Cosmetic\Chatmodule\ChatmoduleEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;

class ChatmoduleMapper
{
    protected $tableName = 'chatmodule';
    protected $dbAdapter;
    protected $sql;

    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        $this->sql = new Sql($dbAdapter);
        $this->sql->setTable($this->tableName);
    }

    //每次开始加载最近的20条
    public function fetchAllbegin($sendid,$receiveid)
    {
    
        $select = $this->sql->select();
        $select->order(array('chatdate DESC'));//按id和按日期，倒叙取值是一样的，输出时必须先转为数组再排序
        $select->limit(5);
        $select->where(array('sendid' => array($sendid,$receiveid),'receiveid'=>array($sendid,$receiveid)));
       
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
    
        $entityPrototype = new ChatmoduleEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //按日期
    public function fetchAlldate($sendid,$receiveid,$date)
    {
    
        $select = $this->sql->select();
        $select->order(array('chatdate DESC'));//按id和按日期，倒叙取值是一样的，输出时必须先转为数组再排序
        $select->limit(100);
        $select->where(array('sendid' => array($sendid,$receiveid),'receiveid'=>array($sendid,$receiveid),'chatdatehistory >='.$date));
         
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
    
        $entityPrototype = new ChatmoduleEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //刷新，读未读的
    public function fetchAllunread($sendid,$receiveid,$unread)
    {
        
        $select = $this->sql->select();
        $select->order(array('chatdate DESC'));
        $select->limit($unread);
        $select->where(array('sendid' => array($sendid),'receiveid'=>array($receiveid)));

        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $entityPrototype = new ChatmoduleEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //自己发送，读一条
    public function fetchAllone($sendid,$receiveid)
    {
    
        $select = $this->sql->select();
        $select->order(array('id DESC'));
        $select->limit(1);
        $select->where(array('sendid' => array($sendid,$receiveid),'receiveid'=>array($sendid,$receiveid)));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
    
        $entityPrototype = new ChatmoduleEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //历史记录，读所有
    public function fetchAllhistory($sendid,$receiveid)
    {
    
        $select = $this->sql->select();
        $select->where(array('sendid' => array($sendid,$receiveid),'receiveid'=>array($sendid,$receiveid)));
        $select->order(array('chatdate ASC'));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
    
        $entityPrototype = new ChatmoduleEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    
public function saveChat(ChatmoduleEntity $task)
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
 
 public function getChat($id)
 {
     $select = $this->sql->select();
     $select->where(array('id' => $id));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $result = $statement->execute()->current();
     if (!$result) {
         return null;
     }
 
     $hydrator = new ClassMethods();
     $task = new ChatmoduleEntity();
     $hydrator->hydrate($result, $task);
 
     return $task;
 }
 
 public function deleteChat($id)
 {
     $delete = $this->sql->delete();
     $delete->where(array('id' => $id));
 
     $statement = $this->sql->prepareStatementForSqlObject($delete);
     return $statement->execute();
 }
}