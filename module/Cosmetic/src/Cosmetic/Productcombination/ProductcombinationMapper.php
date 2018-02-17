<?php
namespace Cosmetic\Productcombination;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class ProductcombinationMapper
{
    protected $tableName="productcombination";
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

        $entityPrototype = new ProductcombinationEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveProductcombination(ProductcombinationEntity $productcombination)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($productcombination);
    
        if ($productcombination->getProductcombinationid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('productcombinationid' => $productcombination->getProductcombinationid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['productcombinationid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$productcombination->getProductcombinationid()) {
            $productcombination->setProductcombinationid($result->getGeneratedValue());
        }
        return $result;
    }
    //取得此美容院此次产品所有组合分类
    public function getProductcombination($sub)
    {
        $select = $this->sql->select();
        $select->where(array('prodid'=>$sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new ProductcombinationEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //取得此美容院所有组合分类
    public function getProductcombination2($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' =>array($id,1)));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new ProductcombinationEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //按ID取得单个组合分类
    public function getProductcombination1($third)
    {
        $select = $this->sql->select();
        $select->where(array('productcombinationid' => $third));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
          $hydrator = new ClassMethods();
          $salon = new ProductcombinationEntity();
          $hydrator->hydrate($results, $salon);
 
          return $salon;
    }
    
    public function deleteProductcombination($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('productcombinationid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}