<?php
namespace Cosmetic\Customer;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;

class CustomerMapper
{
    protected $tableName="customer";
    protected $dbAdapter;
    protected $sql;
    
    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter=$dbAdapter;
        $this->sql=new Sql($dbAdapter);
        $this->sql->setTable($this->tableName);
       
    }
    public function getCustomerlogin($account,$password)
    {
        $select = $this->sql->select();
        $select->where(array('cusphone' => $account,'cuspassword'=>$password));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();
        if (!$result) {
            return null;
        }
    
        $hydrator = new ClassMethods();
        $cusmoter = new CustomerEntity();
        $hydrator->hydrate($result, $cusmoter);
    
        return $cusmoter;
    }
    public function fetchAll()
    {
        $select=$this->sql->select();
        
        $statement=$this->sql->prepareStatementForSqlObject($select);
        $results=$statement->execute();
        
        $entityPrototype=new CustomerEntity();
        $hydrator=new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
        
    }
    
    
    public function saveCustomer(CustomerEntity $customer)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($customer);
    
        if ($customer->getCusid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('cusid' => $customer->getCusid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['cusid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$customer->getCusid()) {
            $customer->setCusid($result->getGeneratedValue());
        }
        return $result;
    
    }
    public function getCustomer($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        //$select->order(array('cuslevel DESC', 'cusregdate DESC'));
        //$select->join('cusleveltype', 'cusid=cusid','cusid',$select::JOIN_LEFT);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new CustomerEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //联合查询，顾客等级和类型
    public function getCustomerandcusleveltype($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        $select->order(array('cuslevel DESC', 'cusregdate DESC'));
        $select->join(
            'cusleveltype', // table name
            'cusleveltype.cusid = customer.cusid', // expression to join on (will be quoted by platform object before insertion),
            array('cuslevel','custype','cussalonbranch','cuspoints'), // (optional) list of columns, same requirements as columns() above
            $select::JOIN_LEFT // (optional), one of inner, outer, left, right also represented by constants in the API
            );
        
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
        $entityPrototype = new Customer2Entity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function getCustomer1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('cusid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();
        if (!$result) {
            return null;
        }
    
        $hydrator = new ClassMethods();
        $customer = new CustomerEntity();
        $hydrator->hydrate($result, $customer);
    
        return $customer;
    }
    
    public function getCustomer2($cusphone,$cuspassword)
    {
        $select = $this->sql->select();
        $select->where(array('cusphone' => $cusphone,'cuspassword'=>$cuspassword));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();
        if (!$result) {
            return null;
        }
    
        $hydrator = new ClassMethods();
        $customer = new CustomerEntity();
        $hydrator->hydrate($result, $customer);
    
        return $customer;
    }
    //判断手机号是否已存在
    public function getCustomerexist($cusphone)
    {
        $select = $this->sql->select();
        $select->where(array('cusphone' => $cusphone));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();
        if (!$result) {
            return null;
        }
    
        $hydrator = new ClassMethods();
        $customer = new CustomerEntity();
        $hydrator->hydrate($result, $customer);
    
        return $customer;
    }
    
    public function deleteCustomer($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('cusid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}