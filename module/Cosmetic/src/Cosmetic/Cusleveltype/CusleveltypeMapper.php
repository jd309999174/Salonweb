<?php
namespace Cosmetic\Cusleveltype;

use Zend\Db\Adapter\Adapter;
use Cosmetic\Cusleveltype\CusleveltypeEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;

class CusleveltypeMapper
{
    protected $tableName = 'cusleveltype';
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

        $entityPrototype = new CusleveltypeEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
public function saveTask(CusleveltypeEntity $task)
 {
     $hydrator = new ClassMethods();
     $data = $hydrator->extract($task);

     if ($task->getId()) {
         // update action
         $action = $this->sql->update();
         $action->set($data);
         $action->where(array('cusid' => $task->getCusid()));
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
     $select->where(array('cusid' => $id));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $result = $statement->execute()->current();
     if (!$result) {
         return null;
     }
 
     $hydrator = new ClassMethods();
     $task = new CusleveltypeEntity();
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