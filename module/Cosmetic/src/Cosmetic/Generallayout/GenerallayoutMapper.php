<?php
namespace Cosmetic\Generallayout;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class GenerallayoutMapper
{
    protected $tableName="generallayout";
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

        $entityPrototype = new GenerallayoutEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveGenerallayout(GenerallayoutEntity $generallayout)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($generallayout);
    
        if ($generallayout->getGlid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('glid' => $generallayout->getGlid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['glid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$generallayout->getGlid()) {
            $generallayout->setGlid($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院所有促销活动
    public function getGenerallayout($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new GenerallayoutEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //按ID取得单个活动
    public function getGenerallayout1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('glid' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
          $hydrator = new ClassMethods();
          $generallayout = new GenerallayoutEntity();
          $hydrator->hydrate($results, $generallayout);
 
          return $generallayout;
    }
    //按用户获取
    public function getGenerallayout2($sub)
    {
        $select = $this->sql->select();
        $select->where(array('cusnumber' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
        $hydrator = new ClassMethods();
        $generallayout = new GenerallayoutEntity();
        $hydrator->hydrate($results, $generallayout);
    
        return $generallayout;
    }
    
    public function deleteGenerallayout($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('glid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}