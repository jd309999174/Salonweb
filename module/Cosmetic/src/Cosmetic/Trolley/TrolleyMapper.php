<?php
namespace Cosmetic\Trolley;

use Zend\Db\Adapter\Adapter;
use Cosmetic\Trolley\TrolleyEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;

class TrolleyMapper
{
    protected $tableName = 'trolley';
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

        $entityPrototype = new TrolleyEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
public function saveTrolley(TrolleyEntity $Trolley)
 {
     $hydrator = new ClassMethods();
     $data = $hydrator->extract($Trolley);

     if ($Trolley->getTrolleyid()) {
         // update action
         $action = $this->sql->update();
         $action->set($data);
         $action->where(array('trolleyid' => $Trolley->getTrolleyid()));
     } else {
         // insert action
         $action = $this->sql->insert();
         unset($data['trolleyid']);
         $action->values($data);
     }
     $statement = $this->sql->prepareStatementForSqlObject($action);
     $result = $statement->execute();

     if (!$Trolley->getTrolleyid()) {
         $Trolley->setTrolleyid($result->getGeneratedValue());
     }
     return $result;

 }
 
 //按id取单个购物车
 public function getTrolley($id)
 {
     $select = $this->sql->select();
     $select->where(array('trolleyid' => $id));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $result = $statement->execute()->next();
     if (!$result) {
         return null;
     }
 
     $hydrator = new ClassMethods();
     $Trolley = new TrolleyEntity();
     $hydrator->hydrate($result, $Trolley);
 
     return $Trolley;
 }
 
 //按用户id取用户购物车
 public function getTrolleys($id)
 {
     $select = $this->sql->select();
     $select->where(array('cusid' => $id));
     //$select->order(array('salid ASC', 'salnumber ASC'));
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     if (!$results) {
         return null;
     }
 
 
     $entityPrototype = new TrolleyEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 public function deleteTrolley($id)
 {
     $delete = $this->sql->delete();
     $delete->where(array('trolleyid' => $id));
 
     $statement = $this->sql->prepareStatementForSqlObject($delete);
     return $statement->execute();
 }
}