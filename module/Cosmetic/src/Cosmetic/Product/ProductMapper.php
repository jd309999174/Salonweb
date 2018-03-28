<?php
namespace Cosmetic\Product;

use Zend\Db\Adapter\Adapter as DbAdapter;
use Cosmetic\Product\ProductEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Where;

class ProductMapper
{
    protected $tableName = 'product';
    protected $dbAdapter;
    protected $sql;

    
    public function __construct(DbAdapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        $this->sql = new Sql($dbAdapter);
        $this->sql->setTable($this->tableName);
    }

    public function fetchAll()
    {
        $select = $this->sql->select();

        $select->order(array('prodid ASC', 'salnumber ASC'));
        
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $entityPrototype = new ProductEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
public function saveProduct(ProductEntity $product)
 {
     $hydrator = new ClassMethods();
     $data = $hydrator->extract($product);

     if ($product->getProdid()) {
         // update action
         $action = $this->sql->update();
         $action->set($data);
         $action->where(array('Prodid' => $product->getProdid()));
     } else {
         // insert action
         $action = $this->sql->insert();
         unset($data['Prodid']);
         $action->values($data);
     }
     $statement = $this->sql->prepareStatementForSqlObject($action);
     $result = $statement->execute();

     if (!$product->getProdid()) {
         $product->setProdid($result->getGeneratedValue());
     }
     return $result;

 }
 //按美容院编号搜索所有产品，包括我的产品
 public function getProduct($id)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => array($id,1)));
     $select->order(array('prodid ASC', 'salnumber ASC'));
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     if (!$results) {
         return null;
     }


     $entityPrototype = new ProductEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //按美容院编号搜索所有产品，包括我的产品          下拉加载更多
 public function getProductoffset($id,$prodoffset,$prodorder,$prodtitle)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => array($id,1),'prodtitle LIKE "%'.$prodtitle.'%"'));
     switch ($prodorder)
     {
         case "prodsynthesis":
             //$select->order(array('prodid ASC', 'salnumber ASC'));//综合就是无排序
             break;
         case "prodpriceup":
             $select->order(array('prodprice ASC'));//价格升
             break;
         case "prodpricedown":
             $select->order(array('prodprice DESC'));//价格降
             break;
         case "prodsales":
             $select->order(array('prodsales DESC'));//销量
             break;
         case "prodregdate":
             $select->order(array('prodid DESC'));//新品就是按id来排序
             break;
         default:
             //无排序
     }
     $select->order(array('prodid ASC', 'salnumber ASC'));
     $select->limit(10);
     $select->offset($prodoffset*10);
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     if (!$results) {
         return null;
     }
     
     
     $entityPrototype = new ProductEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //按美容院编号搜索所有产品，包括我的产品
 public function getProductedit($id)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => array($id)));
     $select->order(array('prodid ASC', 'salnumber ASC'));
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     if (!$results) {
         return null;
     }
     
     
     $entityPrototype = new ProductEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //搜索分店号为1的美容院
 public function getProductbranch1($id)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => $id,'salbranch'=>1));
     $select->order(array('prodid ASC', 'salnumber ASC'));
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute()->current();
     if (!$results) {
         return null;
     }
 
     $hydrator = new ClassMethods();
     $product = new ProductEntity();
     $hydrator->hydrate($results, $product);
 
     return $product;
 
 }
 //按id搜索单个产品
 public function getProduct1($sub)
 {
     $select = $this->sql->select();
     $select->where(array('prodid'=>$sub));
     $select->order(array('prodid ASC', 'salnumber ASC'));
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute()->current();
     if (!$results) {
         return null;
     }
 
          $hydrator = new ClassMethods();
          $product = new ProductEntity();
          $hydrator->hydrate($results, $product);
 
          return $product;

 }
 
 
 public function deleteProduct($sub)
 {
     $delete = $this->sql->delete();
     $delete->where(array('prodid'=>$sub));
 
     $statement = $this->sql->prepareStatementForSqlObject($delete);
     return $statement->execute();
 }
}