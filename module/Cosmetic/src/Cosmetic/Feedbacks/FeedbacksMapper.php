<?php
namespace Cosmetic\Feedbacks;

use Zend\Db\Adapter\Adapter;
use Cosmetic\Feedbacks\FeedbacksEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Where;

class FeedbacksMapper
{
    protected $tableName = 'feedbacks';
    protected $dbAdapter;
    protected $sql;

    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        $this->sql = new Sql($dbAdapter);
        $this->sql->setTable($this->tableName);
    }

    public function fetchAll()
    {
        $select = $this->sql->select();
        //$select->order(array('completed ASC', 'created ASC'));

        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        $entityPrototype = new FeedbacksEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
public function saveTask(FeedbacksEntity $task)
 {
     $hydrator = new ClassMethods();
     $data = $hydrator->extract($task);

     if ($task->getId()) {
         // update action
         $action = $this->sql->update();
         $action->set($data);
         $action->where(array('id' => $task->getId()));
     } else {
         // insert action
         $action = $this->sql->insert();
         unset($data['id']);
         $action->values($data);
     }
     $statement = $this->sql->prepareStatementForSqlObject($action);
     $result = $statement->execute();

     if (!$task->getId()) {
         $task->setId($result->getGeneratedValue());
     }
     return $result;

 }
 

 public function getTask($id)
 {
     $select = $this->sql->select();
     $select->where(array('id' => $id));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $result = $statement->execute()->current();
     if (!$result) {
         return null;
     }
 
     $hydrator = new ClassMethods();
     $task = new FeedbacksEntity();
     $hydrator->hydrate($result, $task);
 
     return $task;
 }
 
 
 
 //按美容师id获取以服务过的记录
 public function getTask1($cosid)
 {
     $select = $this->sql->select();
     $select->where(array('cosid' => $cosid));
     $select->order(array('gmtfbdate DESC'));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
 
     $entityPrototype = new FeedbacksEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //按美容师id获取最近30次记录
 public function getTask11($cosid)
 {
     $select = $this->sql->select();
     $select->where(array('cosid' => $cosid));
     $select->limit(30);
     $select->order(array('id DESC'));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
 
     $entityPrototype = new FeedbacksEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //按美容院id和分院号获取最近30次记录
 public function getTask111($salnumber,$salbranch)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => $salnumber,'salbranch'=>$salbranch));
     $select->limit(30);
     //$select->order(array('completed ASC', 'created ASC'));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
 
     $entityPrototype = new FeedbacksEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //按美容院id和分院号获取
 public function getSalbranch($salnumber,$salbranch)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => $salnumber,'salbranch'=>$salbranch));
     //$select->limit(30);
     $select->order(array('gmtfbdate DESC'));
     
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     
     $entityPrototype = new FeedbacksEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //按疗程id，取出所有反馈
 public function getTask2($treid)
 {
     $select = $this->sql->select();
     $select->where(array('treid' => $treid));
     $select->order(array('fbdate ASC'));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
 
     $entityPrototype = new FeedbacksEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //按疗程id，取出所有反馈
 public function getFeedbacksonprodid($prodid)
 {
     $select = $this->sql->select();
     $select->where(array('prodid' => $prodid));
     $select->order(array('gmtfbdate DESC'));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
 
     $entityPrototype = new FeedbacksEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //产品评价
 public function getFeedbacksprod($prodid,$commentoffset)
 {
     $select = $this->sql->select();
     $select->where(array('prodid' => $prodid));
     $select->order(array('gmtfbdate DESC'));
     $select->limit(10);
     $select->offset($commentoffset*10);
     
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     
     $entityPrototype = new FeedbacksEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //美容师评价
 public function getFeedbackscos($cosid,$commentoffset)
 {
     $select = $this->sql->select();
     $select->where(array('cosid' => $cosid));
     $select->order(array('gmtfbdate DESC'));
     $select->limit(10);
     $select->offset($commentoffset*10);
     
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     
     $entityPrototype = new FeedbacksEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //美容院评价
 public function getFeedbackssalbranch($salnumber,$salbranch,$commentoffset)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => $salnumber,'salbranch'=>$salbranch));
     $select->order(array('gmtfbdate DESC'));
     $select->limit(10);
     $select->offset($commentoffset*10);
     
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     
     $entityPrototype = new FeedbacksEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 //按salnumber，取出所有反馈
 public function getFeedbackssalnumber($salnumber)
 {
     $select = $this->sql->select();
     $select->where(array('salnumber' => $salnumber));
     $select->order(array('fbdate ASC'));
 
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
 
     $entityPrototype = new FeedbacksEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 
 //按日期获取和美容院id获取
 public function getFeedbacksongmtfbdate($id,$minValue,$maxValue)
 {
     $select = $this->sql->select();
     //$select->where(array('salnumber' => $id));
     //$select->order(array('salid ASC', 'salnumber ASC'));
     $where=new Where();
     $where->equalTo('salnumber', $id);
     $where->between('gmtfbdate', $minValue, $maxValue);
     $select->where($where);
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $results = $statement->execute();
     if (!$results) {
         return null;
     }
 
 
     $entityPrototype = new FeedbacksEntity();
     $hydrator = new ClassMethods();
     $resultset = new HydratingResultSet($hydrator, $entityPrototype);
     $resultset->initialize($results);
     return $resultset;
 }
 
 //取出美容院7天订单数
 public function getSevendayscount($id)
 {
     $nowValue=date("YmdHis",time());//现在时间
     $todayago=date("Ymd",time())."000000";//今天凌晨
     $onedayago=date("Ymd",strtotime('-1 day'))."000000";//昨天凌晨
     $twodaysago=date("Ymd",strtotime('-2 day'))."000000";//前天凌晨
     $threedaysago=date("Ymd",strtotime('-3 day'))."000000";//大前天凌晨
     $fourdaysago=date("Ymd",strtotime('-4 day'))."000000";//大大前天凌晨
     $fivedaysago=date("Ymd",strtotime('-5 day'))."000000";//大大大前天凌晨
     $sixdaysago=date("Ymd",strtotime('-6 day'))."000000";//大大大大前天凌晨
     
     //7
     $select = $this->sql->select();
     $where=new Where();
     $where->equalTo('salnumber', $id);
     
     $where->between('gmtfbdate', $sixdaysago, $fivedaysago);
     $select->where($where);
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $seven = $statement->execute()->count();
     //6
     $select = $this->sql->select();
     $where=new Where();
     $where->equalTo('salnumber', $id);
     
     $where->between('gmtfbdate', $fivedaysago, $fourdaysago);
     $select->where($where);
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $six = $statement->execute()->count();
     //5
     $select = $this->sql->select();
     $where=new Where();
     $where->equalTo('salnumber', $id);
     
     $where->between('gmtfbdate', $fourdaysago, $threedaysago);
     $select->where($where);
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $five = $statement->execute()->count();
     //4
     $select = $this->sql->select();
     $where=new Where();
     $where->equalTo('salnumber', $id);
     
     $where->between('gmtfbdate', $threedaysago, $twodaysago);
     $select->where($where);
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $four = $statement->execute()->count();
     //3
     $select = $this->sql->select();
     $where=new Where();
     $where->equalTo('salnumber', $id);
     
     $where->between('gmtfbdate', $twodaysago, $onedayago);
     $select->where($where);
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $three = $statement->execute()->count();
     //2
     $select = $this->sql->select();
     $where=new Where();
     $where->equalTo('salnumber', $id);
     
     $where->between('gmtfbdate', $onedayago, $todayago);
     $select->where($where);
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $two = $statement->execute()->count();
     //1
     $select = $this->sql->select();
     $where=new Where();
     $where->equalTo('salnumber', $id);
     
     $where->between('gmtfbdate', $todayago, $nowValue);
     $select->where($where);
     $statement = $this->sql->prepareStatementForSqlObject($select);
     $one = $statement->execute()->count();
     
     
     $resultset=array($one,$two,$three,$four,$five,$six,$seven);
     return $resultset;
 }
 
 
 public function deleteTask($id)
 {
     $delete = $this->sql->delete();
     $delete->where(array('id' => $id));
 
     $statement = $this->sql->prepareStatementForSqlObject($delete);
     return $statement->execute();
 }
}