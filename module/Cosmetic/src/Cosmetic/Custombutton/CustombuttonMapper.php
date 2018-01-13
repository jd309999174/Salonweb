<?php
namespace Cosmetic\Custombutton;

use Zend\Db\Adapter\Adapter;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;

class CustombuttonMapper
{
    protected $tableName = 'custombutton';
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

        $entityPrototype = new CustombuttonEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
public function saveCustombutton(CustombuttonEntity $task)
 {
     $hydrator = new ClassMethods();
     $data = $hydrator->extract($task);

     if ($task->getButtonid()) {
         // update action
         $action = $this->sql->update();
         $action->set($data);
         $action->where(array('buttonid' => $task->getButtonid()));
     } else {
         // insert action
         $action = $this->sql->insert();
         unset($data['buttonid']);
         $action->values($data);
     }
     $statement = $this->sql->prepareStatementForSqlObject($action);
     $result = $statement->execute();

     if (!$task->getButtonid()) {
         $task->setButtonid($result->getGeneratedValue());
     }
     return $result;

 }
 
 
 public function getCustombuttons($salnumber)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => $salnumber));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
 
     $entityPrototype = new CustombuttonEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 
 public function getCustombutton($buttonid)
 {
     $select = $this->sql->select();
     $select->where(array('buttonid' => $buttonid));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $result = $statement->execute()->current();
     if (!$result) {
         return null;
     }
 
     $hydrator = new ClassMethods();
     $task = new CustombuttonEntity();
     $hydrator->hydrate($result, $task);
 
     return $task;
 }
 
 public function deleteCustombutton($buttonid)
 {
     $delete = $this->sql->delete();
     $delete->where(array('buttonid' => $buttonid));
 
     $statement = $this->sql->prepareStatementForSqlObject($delete);
     return $statement->execute();
 }
}