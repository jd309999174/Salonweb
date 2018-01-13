<?php
namespace Cosmetic\Stage;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class StageMapper
{
    protected $tableName="stage";
    protected $dbAdapter;
    protected $sql;
    
    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter=$dbAdapter;
        $this->sql=new Sql($dbAdapter);
        $this->sql->setTable($this->tableName);
       
    }
    
    public function fetchAll()
    {
        $select=$this->sql->select();
        
        $statement=$this->sql->prepareStatementForSqlObject($select);
        $results=$statement->execute();
        
        $entityPrototype=new StageEntity();
        $hydrator=new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
        
    }
    
    public function saveStage(StageEntity $stage)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($stage);
    
        if ($stage->getStaid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('staid' => $stage->getStaid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['staid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$stage->getStaid()) {
            $stage->setStaid($result->getGeneratedValue());
        }
        return $result;
    
    }
    //取得此美容院所有阶段
    public function getStage1($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new StageEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function getStage($id)
    {
        $select = $this->sql->select();
        $select->where(array('staid' => $id));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();
        if (!$result) {
            return null;
        }
    
        $hydrator = new ClassMethods();
        $stage = new StageEntity();
        $hydrator->hydrate($result, $stage);
    
        return $stage;
    }
    
    public function deleteStage($id)
    {
        $delete = $this->sql->delete();
        $delete->where(array('staid' => $id));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}