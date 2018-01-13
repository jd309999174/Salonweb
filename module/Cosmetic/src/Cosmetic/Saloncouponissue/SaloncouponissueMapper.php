<?php
namespace Cosmetic\Saloncouponissue;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class saloncouponissueMapper
{
    protected $tableName="saloncouponissue";
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

        $entityPrototype = new SaloncouponissueEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveSaloncouponissue(SaloncouponissueEntity $saloncouponissue)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($saloncouponissue);
    
        if ($saloncouponissue->getSciid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('sciid' => $saloncouponissue->getSciid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['sciid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$saloncouponissue->getSciid()) {
            $saloncouponissue->setSciid($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院所有优惠券
    public function getSaloncouponissue($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new SaloncouponissueEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    
  
    //按ID取得单个优惠券 
    public function getSaloncouponissue1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('sciid' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
          $hydrator = new ClassMethods();
          $saloncouponissue = new SaloncouponissueEntity();
          $hydrator->hydrate($results, $saloncouponissue);
 
          return $saloncouponissue;
    }
    //按salnumber取得单个活动
    public function getSaloncouponissue2($sub)
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
        $saloncouponissue = new SaloncouponissueEntity();
        $hydrator->hydrate($results, $saloncouponissue);
    
        return $saloncouponissue;
    }
    
    //取得此用户所有优惠券
    public function getSaloncouponissue3($id,$cusid)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id,'cusid'=>array(0,$cusid)));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new SaloncouponissueEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //按美容院，客户，价格，时间，搜索符合条件的已发布的优惠券
    public function getSaloncouponissue4($id,$cusid,$price)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id,'cusid'=>array(0,$cusid),'scirestriction<='.$price,'comparedate>'.strtotime("now")));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    

        $entityPrototype = new SaloncouponissueEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    public function deleteSaloncouponissue($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('sciid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}
