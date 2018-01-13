<?php
namespace Cosmetic\Salonlayout;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class salonlayoutMapper
{
    protected $tableName="salonlayout";
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

        $entityPrototype = new SalonlayoutEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveSalonlayout(SalonlayoutEntity $salonlayout)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($salonlayout);
    
        if ($salonlayout->getSlid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('slid' => $salonlayout->getSlid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['slid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$salonlayout->getSlid()) {
            $salonlayout->setSlid($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院所有布局
    public function getSalonlayout($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new SalonlayoutEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //按ID取得单个活动
    public function getSalonlayout1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('slid' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
          $hydrator = new ClassMethods();
          $salonlayout = new SalonlayoutEntity();
          $hydrator->hydrate($results, $salonlayout);
 
          return $salonlayout;
    }
    //按salnumber取得单个活动
    public function getSalonlayout2($sub)
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
        $salonlayout = new SalonlayoutEntity();
        $hydrator->hydrate($results, $salonlayout);
    
        return $salonlayout;
    }
    
    public function deleteSalonlayout($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('slid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}
