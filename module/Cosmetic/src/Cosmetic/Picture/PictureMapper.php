<?php
namespace Cosmetic\Picture;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class PictureMapper
{
    protected $tableName="picture";
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

        $entityPrototype = new PictureEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function savePicture(PictureEntity $picture)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($picture);
    
        if ($picture->getPicid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('picid' => $picture->getPicid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['picid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$picture->getPicid()) {
            $picture->setPicid($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院所有促销活动
    public function getPicture($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new PictureEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //按ID取得单个活动
    public function getPicture1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('picid' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
          $hydrator = new ClassMethods();
          $salon = new PictureEntity();
          $hydrator->hydrate($results, $salon);
 
          return $salon;
    }
    
    public function deletePicture($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('picid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}