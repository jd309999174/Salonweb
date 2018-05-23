<?php
namespace Cosmetic\Treatment;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Predicate\Predicate;
class TreatmentMapper
{
    protected $tableName="treatment";
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
        $entityPrototype = new TreatmentEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveTreatment(TreatmentEntity $treatment)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($treatment);
    
        if ($treatment->getTreid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('treid' => $treatment->getTreid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['treid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$treatment->getTreid()) {
            $treatment->setTreid($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院所有订单
    public function getTreatment($id)
    {
        $select = $this->sql->select();
        //$select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        
        $where=new Where();
        $where->equalTo('salnumber', $id);
        $where->OR;
        $where->equalTo('prodsalnumber', $id);
        $select->where($where);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
      
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new TreatmentEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //按ID取得单个订单
    public function getTreatment1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('treid' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
          $hydrator = new ClassMethods();
          $salon = new TreatmentEntity();
          $hydrator->hydrate($results, $salon);
 
          return $salon;
    }
    //取得最近订单
    public function getTreatmentlatest($cusid)
    {
        $select = $this->sql->select();
        $select->where(array('cusid' => $cusid,'trestate'=>'paid'));
        $select->order(array('gmtclose DESC'));
        $select->limit(1);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
        
        
        $hydrator = new ClassMethods();
        $salon = new TreatmentEntity();
        $hydrator->hydrate($results, $salon);
        
        return $salon;
    }
    
    //按用户id取得所有订单
    public function getTreatment2($id)
    {
        $select = $this->sql->select();
        $select->where(array('cusid' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new TreatmentEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //按用户id取得所有已支付订单   供美容师使用
    public function getTreatment3($id)
    {
        $select = $this->sql->select();
        $select->where(array('cusid' => $id,'trestate'=>'paid'));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new TreatmentEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //按订单id,金额，查询是否有此订单
    public function getTreatmentcheckout($orderid,$tradeno)
    {
        $select = $this->sql->select();
        $select->where(array('orderid' => $orderid,'treprice'=>$tradeno));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
        $hydrator = new ClassMethods();
        $salon = new TreatmentEntity();
        $hydrator->hydrate($results, $salon);
    
        return $salon;
    }
    
    //按日期获取和美容院id获取
    public function getTreatmentongmtclose($id,$minValue,$maxValue)
    {
        $select = $this->sql->select();
        //$select->where(array('salnumber' => $id,'trestate'=>'paid'));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $where=new Where();
        $where->equalTo('salnumber', $id);
        $where->equalTo('trestate', 'paid');
        $where->between('gmtclose', $minValue, $maxValue);
        $select->where($where);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new TreatmentEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    public function deleteTreatment($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('treid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}