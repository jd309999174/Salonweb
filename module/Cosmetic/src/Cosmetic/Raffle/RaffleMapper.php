<?php
namespace Cosmetic\Raffle;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class RaffleMapper
{
    protected $tableName="raffle";
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
        
        $entityPrototype=new RaffleEntity();
        $hydrator=new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
        
    }
    
    public function saveRaffle(RaffleEntity $raffle)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($raffle);
    
        if ($raffle->getId()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('id' => $raffle->getId()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['id']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$raffle->getId()) {
            $raffle->setId($result->getGeneratedValue());
        }
        return $result;
    
    }
    
    public function getRaffle($id)
    {
        $select = $this->sql->select();
        $select->where(array('id' => $id));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();
        if (!$result) {
            return null;
        }
    
        $hydrator = new ClassMethods();
        $raffle = new RaffleEntity();
        $hydrator->hydrate($result, $raffle);
    
        return $raffle;
    }
    
    public function deleteRaffle($id)
    {
        $delete = $this->sql->delete();
        $delete->where(array('id' => $id));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}