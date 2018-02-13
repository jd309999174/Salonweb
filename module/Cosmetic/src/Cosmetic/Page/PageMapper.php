<?php
namespace Cosmetic\Page;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class PageMapper
{
    protected $tableName="pageitem";
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

        $entityPrototype = new PageEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    public function savePage(PageEntity $page)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($page);
    
        if ($page->getPageid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('pageid' => $page->getPageid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['pageid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$page->getPageid()) {
            $page->setPageid($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院所有促销活动
    public function getPage($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id,'pagetype'=>array('首页','活动','动态')));
        $select->order(array('modificationtime DESC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new PageEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //取得此美容院所有促销活动
    public function getPageactivity($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id,'pagetype'=>array('活动','动态')));
        $select->order(array('modificationtime DESC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
        
        
        $entityPrototype = new PageEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //取得此美容院所有促销活动
    public function getPagesalonbranch($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id,'pagetype'=>array('salonbranch')));
        $select->order(array('modificationtime DESC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
        
        
        $entityPrototype = new PageEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //取得此美容院所有促销活动
    public function getPagecosmetologist($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id,'pagetype'=>array('cosmetologist')));
        $select->order(array('modificationtime DESC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
        
        
        $entityPrototype = new PageEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //取得此美容院所有活动页
    public function getActivitypages($id,$pagetype)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id,'pagetype'=>$pagetype));
        $select->order(array('modificationtime DESC'));
        $select->limit(50);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new PageEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //取得此美容院所有促销活动
    public function getPage2($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' =>array($id,0)));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new PageEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //按ID取得单个活动
    public function getPage1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('pageid' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
          $hydrator = new ClassMethods();
          $salon = new PageEntity();
          $hydrator->hydrate($results, $salon);
 
          return $salon;
    }
    //按salumber,和pagename取得首页id
    public function getHomepage($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber'=>$id,'pagetype' => '首页'));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
        $hydrator = new ClassMethods();
        $salon = new PageEntity();
        $hydrator->hydrate($results, $salon);
    
        return $salon;
    }
    public function deletePage($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('pageid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    //取得分院页面
    public function getSalbranch($salid)
    {
        $select = $this->sql->select();
        $select->where(array('pagetype'=>"salbranch",'pageheaddata1'=>$salid));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
        
        
        $hydrator = new ClassMethods();
        $salon = new PageEntity();
        $hydrator->hydrate($results, $salon);
        
        return $salon;
    }
    public function deleteSalbranch($salid)
    {
        $delete = $this->sql->delete();
        $delete->where(array('pageheaddata1' => $salid));
        
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    //取得美容师页面
    public function getCosmetologist($cosid)
    {
        $select = $this->sql->select();
        $select->where(array('pagetype'=>"cosmetologist",'pageheaddata1'=>$cosid));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
        
        
        $hydrator = new ClassMethods();
        $salon = new PageEntity();
        $hydrator->hydrate($results, $salon);
        
        return $salon;
    }
    public function deleteCosmetologist($cosid)
    {
        $delete = $this->sql->delete();
        $delete->where(array('pageheaddata1' => $cosid));
        
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}