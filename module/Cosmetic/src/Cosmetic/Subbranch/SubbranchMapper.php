<?php
namespace Cosmetic\Subbranch;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class SubbranchMapper
{
    protected $tableName="subbranch";
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
        
        $entityPrototype=new SubbranchEntity();
        $hydrator=new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
        
    }
    
    public function saveSubbranch(SubbranchEntity $subbranch)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($subbranch);
    
        if ($subbranch->getId()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('id' => $subbranch->getId()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['id']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$subbranch->getId()) {
            $subbranch->setId($result->getGeneratedValue());
        }
        return $result;
    
    }
    
    public function getSubbranch($id)
    {
        $select = $this->sql->select();
        $select->where(array('id' => $id));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();
        if (!$result) {
            return null;
        }
    
        $hydrator = new ClassMethods();
        $subbranch = new SubbranchEntity();
        $hydrator->hydrate($result, $subbranch);
    
        return $subbranch;
    }
    
    public function deleteSubbranch($id)
    {
        $delete = $this->sql->delete();
        $delete->where(array('id' => $id));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}