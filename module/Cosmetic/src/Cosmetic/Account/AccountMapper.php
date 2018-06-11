<?php
namespace Cosmetic\Account;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class AccountMapper
{
    protected $tableName="account";
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

        $entityPrototype = new AccountEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveAccount(AccountEntity $account)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($account);
    
        if ($account->getAccountid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('accountid' => $account->getAccountid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['accountid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$account->getAccountid()) {
            $account->setAccountid($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院所有促销活动
    public function getAccount($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();;
        if (!$results) {
            return null;
        }
    
    
        $hydrator = new ClassMethods();
        $salon = new AccountEntity();
        $hydrator->hydrate($results, $salon);
        
        return $salon;
    }
    
    //按ID取得单个活动
    public function getAccount1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('accountid' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
          $hydrator = new ClassMethods();
          $salon = new AccountEntity();
          $hydrator->hydrate($results, $salon);
 
          return $salon;
    }
    //按ID取得单个活动
    public function getSalbossphoneexist($sub)
    {
        $select = $this->sql->select();
        $select->where(array('salbossphone' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
        
        
        $hydrator = new ClassMethods();
        $salon = new AccountEntity();
        $hydrator->hydrate($results, $salon);
        
        return $salon;
    }
    //login
    public function getAccountlogin($salbossphone,$salpassword)
    {
        $select = $this->sql->select();
        $select->where(array('salbossphone' => $salbossphone,'salpassword'=>$salpassword));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
        $hydrator = new ClassMethods();
        $salon = new AccountEntity();
        $hydrator->hydrate($results, $salon);
    
        return $salon;
    }
    //判断账号是否已存在
    public function getAccountexist($salaccount)
    {
        $select = $this->sql->select();
        $select->where(array('salaccount' => $salaccount));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
        $hydrator = new ClassMethods();
        $salon = new AccountEntity();
        $hydrator->hydrate($results, $salon);
    
        return $salon;
    }
    public function deleteAccount($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('accountid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}