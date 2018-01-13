<?php
namespace Cosmetic\Prize;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class PrizeMapper
{
    protected $tableName="prize";
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
        $select = $this->sql->select();

        $select->order(array('salnumber ASC', 'salnumber ASC'));
        
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $entityPrototype = new PrizeEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function savePrize(PrizeEntity $prize)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($prize);
    
        if ($prize->getPriid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('priid' => $prize->getPriid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['priid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$prize->getPriid()) {
            $prize->setPriid($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院所有促销活动
    public function getPrize($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new PrizeEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //按ID取得单个活动
    public function getPrize1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('priid' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
          $hydrator = new ClassMethods();
          $salon = new PrizeEntity();
          $hydrator->hydrate($results, $salon);
 
          return $salon;
    }
    
    public function deletePrize($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('priid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}