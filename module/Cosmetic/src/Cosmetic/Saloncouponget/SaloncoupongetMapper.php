<?php
namespace Cosmetic\Saloncouponget;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class saloncoupongetMapper
{
    protected $tableName="saloncouponget";
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

        $entityPrototype = new SaloncoupongetEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveSaloncouponget(SaloncoupongetEntity $saloncouponget)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($saloncouponget);
    
        if ($saloncouponget->getScgid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('scgid' => $saloncouponget->getScgid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['scgid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$saloncouponget->getScgid()) {
            $saloncouponget->setScgid($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院所有优惠券
    public function getSaloncouponget($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new SaloncoupongetEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //按优惠券ID和用户id取得此用户的领取次数
    public function getSaloncouponget1($id,$sub)
    {
        $select = $this->sql->select();
        $select->where(array('cusid' => $id,'sciid'=>$sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new SaloncoupongetEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //按salnumber取得单个活动
    public function getSaloncouponget2($sub)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
        $hydrator = new ClassMethods();
        $saloncouponget = new SaloncoupongetEntity();
        $hydrator->hydrate($results, $saloncouponget);
    
        return $saloncouponget;
    }
    
    //按美容院id和用户id取得此用户所有优惠券
    public function getSaloncouponget3($id,$sub)
    {
        $select = $this->sql->select();
        $select->where(array('cusid' => $id,'sciid'=>$sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new SaloncoupongetEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //按美容院id,顾客id，和未使用，取出已有的未使用的优惠券
    public function getSaloncouponget4($id,$cusid)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id,'cusid'=>$cusid,'scgstate'=>'unused'));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new SaloncoupongetEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //按美容院id，用户id,优惠券id，和未使用，取出第一条
    public function getSaloncouponget5($id,$cusid,$sciid)
    {
        $select = $this->sql->select();
        $select->limit(1);
        $select->where(array('salnumber' => $id,'cusid'=>$cusid,'sciid'=>$sciid,'scgstate'=>"unused"));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
        $hydrator = new ClassMethods();
        $saloncouponget = new SaloncoupongetEntity();
        $hydrator->hydrate($results, $saloncouponget);
    
        return $saloncouponget;
    }
    

    //按id
    public function getSaloncoupongetused($scgid)
    {
        $select = $this->sql->select();
        $select->limit(1);
        $select->where(array('scgid' => $scgid));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
        $hydrator = new ClassMethods();
        $saloncouponget = new SaloncoupongetEntity();
        $hydrator->hydrate($results, $saloncouponget);
    
        return $saloncouponget;
    }
    
    public function deleteSaloncouponget($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('scgid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}
