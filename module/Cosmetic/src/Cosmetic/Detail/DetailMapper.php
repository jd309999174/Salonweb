<?php
namespace Cosmetic\Detail;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class DetailMapper
{
    protected $tableName="detail";
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
        
        $entityPrototype=new DetailEntity();
        $hydrator=new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
        
    }
    
    public function saveDetail(DetailEntity $detail)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($detail);
    
        if ($detail->getId()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('id' => $detail->getId()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['id']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$detail->getId()) {
            $detail->setId($result->getGeneratedValue());
        }
        return $result;
    
    }
    
    public function getDetail($id)
    {
        $select = $this->sql->select();
        $select->where(array('id' => $id));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();
        if (!$result) {
            return null;
        }
    
        $hydrator = new ClassMethods();
        $detail = new DetailEntity();
        $hydrator->hydrate($result, $detail);
    
        return $detail;
    }
    
    public function deleteDetail($id)
    {
        $delete = $this->sql->delete();
        $delete->where(array('id' => $id));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}