<?php
namespace Cosmetic\Salon;

use Zend\Db\Adapter\Adapter as DbAdapter;
use Cosmetic\Salon\SalonEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;

use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService;
class SalonMapper
{
    protected $tableName = 'salon';
    protected $dbAdapter;
    protected $sql;

    
    public function __construct(DbAdapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        $this->sql = new Sql($dbAdapter);
        $this->sql->setTable($this->tableName);
    }
    public function getSalonlogin1($account,$passwords)
    {
        $auth = new AuthenticationService();
        
        
        $authAdapter = new AuthAdapter($this->dbAdapter,
            'salon',
            'salaccount',
            'salpasswords'
            );
        $authAdapter
        ->setIdentity('jiang')
        ->setCredential('dong')
        ;
        $result = $auth->authenticate($authAdapter);
        return $result;
    }
    public function getSalonlogin($account,$passwords)
    {
        
        $select = $this->sql->select();
        $select->where(array('salaccount' => $account,'salpasswords'=>$passwords));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();
        if (!$result) {
            return null;
        }
    
        $hydrator = new ClassMethods();
        $salon = new SalonEntity();
        $hydrator->hydrate($result, $salon);
    
        return $salon;
    }
    //根据美容院号和分院号获取分院图片
    public function getSalonpicute($salnumber,$salbranch)
    {
    
        $select = $this->sql->select();
        $select->where(array('salnumber' => $salnumber,'salbranch'=>$salbranch));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();
        if (!$result) {
            return null;
        }
    
        $hydrator = new ClassMethods();
        $salon = new SalonEntity();
        $hydrator->hydrate($result, $salon);
    
        return $salon;
    }
    public function fetchAll()
    {
        $select = $this->sql->select();

        $select->order(array('salid ASC', 'salnumber ASC'));
        
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $entityPrototype = new SalonEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
public function saveSalon(SalonEntity $salon)
 {
     $hydrator = new ClassMethods();
     $data = $hydrator->extract($salon);

     if ($salon->getSalid()) {
         // update action
         $action = $this->sql->update();
         $action->set($data);
         $action->where(array('Salid' => $salon->getSalid()));
     } else {
         // insert action
         $action = $this->sql->insert();
         unset($data['Salid']);
         $action->values($data);
     }
     $statement = $this->sql->prepareStatementForSqlObject($action);
     $result = $statement->execute();

     if (!$salon->getSalid()) {
         $salon->setSalid($result->getGeneratedValue());
     }
     return $result;

 }
 //按number搜索美容院加分店
 public function getSalon($id)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => $id));
     $select->order(array('salid ASC', 'salnumber ASC'));
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     if (!$results) {
         return null;
     }
 

     $entityPrototype = new SalonEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //搜索分店号为1的美容院
 public function getSalonbranch1($id)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => $id,'salbranch'=>1));
     $select->order(array('salid ASC', 'salnumber ASC'));
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute()->current();
     if (!$results) {
         return null;
     }
 
     $hydrator = new ClassMethods();
     $salon = new SalonEntity();
     $hydrator->hydrate($results, $salon);
 
     return $salon;
 
 }
 //按美容院编号和分店号搜索单个店铺
 public function getSalon1($sub)
 {
     $select = $this->sql->select();
     $select->where(array('salid'=>$sub));
     $select->order(array('salid ASC', 'salnumber ASC'));
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute()->current();
     if (!$results) {
         return null;
     }
 
          $hydrator = new ClassMethods();
          $salon = new SalonEntity();
          $hydrator->hydrate($results, $salon);
 
          return $salon;

 }
 
 
 public function deleteSalon($sub)
 {
     $delete = $this->sql->delete();
     $delete->where(array('salid'=>$sub));
 
     $statement = $this->sql->prepareStatementForSqlObject($delete);
     return $statement->execute();
 }
}