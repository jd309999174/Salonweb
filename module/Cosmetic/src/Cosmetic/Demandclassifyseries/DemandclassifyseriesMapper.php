<?php
namespace Cosmetic\Demandclassifyseries;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class DemandclassifyseriesMapper
{
    protected $tableName="demandclassifyseries";
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

        $entityPrototype = new DemandclassifyseriesEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveDemandclassifyseries(DemandclassifyseriesEntity $demandclassifyseries)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($demandclassifyseries);
    
        if ($demandclassifyseries->getDcsid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('dcsid' => $demandclassifyseries->getDcsid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['dcsid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$demandclassifyseries->getDcsid()) {
            $demandclassifyseries->setDcsid($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院所有促销活动
    public function getDemandclassifyseries($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new DemandclassifyseriesEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //取得此美容院所有促销活动
    public function getDemandclassifyseries2($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' =>array($id,1)));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new DemandclassifyseriesEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //按ID取得单个活动
    public function getDemandclassifyseries1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('dcsid' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
          $hydrator = new ClassMethods();
          $salon = new DemandclassifyseriesEntity();
          $hydrator->hydrate($results, $salon);
          return $salon;
    }
    
    public function deleteDemandclassifyseries($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('dcsid' => $sub));
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}