<?php
namespace Cosmetic\Lottery;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class LotteryMapper
{
    protected $tableName="lotteryhistory";
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
        
        $entityPrototype = new LotteryEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveLottery(LotteryEntity $Lottery)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($Lottery);
        
        if ($Lottery->getId()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('id' => $Lottery->getId()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['id']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
        
        if (!$Lottery->getId()) {
            $Lottery->setId($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院所有促销活动
    public function getLotterysal($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        $select->order(array('winningtime DESC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
        
        
        $entityPrototype = new LotteryEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //取得此顾客奖品
    public function getLotterycus($id)
    {
        $select = $this->sql->select();
        $select->where(array('cusid' => $id));
        $select->order(array('winningtime DESC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
        
        
        $entityPrototype = new LotteryEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //按ID取得单个活动
    public function getLotteryid($sub)
    {
        $select = $this->sql->select();
        $select->where(array('id' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
        
        
        $hydrator = new ClassMethods();
        $salon = new LotteryEntity();
        $hydrator->hydrate($results, $salon);
        
        return $salon;
    }
    
    
    public function deleteLottery($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('id' => $sub));
        
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}