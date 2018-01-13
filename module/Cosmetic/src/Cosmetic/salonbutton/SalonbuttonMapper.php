<?php
namespace Cosmetic\Salonbutton;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class salonbuttonMapper
{
    protected $tableName="salonbutton";
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

        $entityPrototype = new SalonbuttonEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveSalonbutton(SalonbuttonEntity $salonbutton)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($salonbutton);
    
        if ($salonbutton->getSbid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('sbid' => $salonbutton->getSbid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['sbid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$salonbutton->getSbid()) {
            $salonbutton->setSbid($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院所有布局
    public function getSalonbutton($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new SalonbuttonEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //按ID取得单个活动
    public function getSalonbutton1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('sbid' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
          $hydrator = new ClassMethods();
          $salonbutton = new SalonbuttonEntity();
          $hydrator->hydrate($results, $salonbutton);
 
          return $salonbutton;
    }
    //按salnumber取得单个活动
    public function getSalonbutton2($sub)
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
        $salonbutton = new SalonbuttonEntity();
        $hydrator->hydrate($results, $salonbutton);
    
        return $salonbutton;
    }
    
    public function deleteSalonbutton($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('sbid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}
