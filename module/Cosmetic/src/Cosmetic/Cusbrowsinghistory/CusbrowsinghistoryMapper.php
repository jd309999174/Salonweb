<?php
namespace Cosmetic\Cusbrowsinghistory;

use Zend\Db\Adapter\Adapter;
use Cosmetic\Cusbrowsinghistory\CusbrowsinghistoryEntity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Where;

class CusbrowsinghistoryMapper
{
    protected $tableName = 'cusbrowsinghistory';
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
        $select->order(array('completed ASC', 'created ASC'));
        
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        
        $entityPrototype = new CusbrowsinghistoryEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveTask(CusbrowsinghistoryEntity $task)
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
        $task = new CusbrowsinghistoryEntity();
        $hydrator->hydrate($result, $task);
        
        return $task;
    }
    
    
    public function getCusbrowsingperson($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        $select->group('cusname');
        
        
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        
        $entityPrototype = new CusbrowsinghistoryEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    //按日期获取和美容院id获取
    public function getCusbrowsingongmtcusdate($id,$minValue,$maxValue)
    {
        $select = $this->sql->select();
        //$select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $select->group('cusid');
        $where=new Where();
        $where->equalTo('salnumber', $id);
        $where->between('gmtcusdate', $minValue, $maxValue);
        $select->where($where);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
        
        
        $entityPrototype = new CusbrowsinghistoryEntity();
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
        $select->group('cusid');
        $where=new Where();
        $where->equalTo('salnumber', $id);
        
        $where->between('gmtcusdate', $sixdaysago, $fivedaysago);
        $select->where($where);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $seven = $statement->execute()->count();
        //6
        $select = $this->sql->select();
        $select->group('cusid');
        $where=new Where();
        $where->equalTo('salnumber', $id);
        
        $where->between('gmtcusdate', $fivedaysago, $fourdaysago);
        $select->where($where);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $six = $statement->execute()->count();
        //5
        $select = $this->sql->select();
        $select->group('cusid');
        $where=new Where();
        $where->equalTo('salnumber', $id);
        
        $where->between('gmtcusdate', $fourdaysago, $threedaysago);
        $select->where($where);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $five = $statement->execute()->count();
        //4
        $select = $this->sql->select();
        $select->group('cusid');
        $where=new Where();
        $where->equalTo('salnumber', $id);
        
        $where->between('gmtcusdate', $threedaysago, $twodaysago);
        $select->where($where);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $four = $statement->execute()->count();
        //3
        $select = $this->sql->select();
        $select->group('cusid');
        $where=new Where();
        $where->equalTo('salnumber', $id);
        
        $where->between('gmtcusdate', $twodaysago, $onedayago);
        $select->where($where);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $three = $statement->execute()->count();
        //2
        $select = $this->sql->select();
        $select->group('cusid');
        $where=new Where();
        $where->equalTo('salnumber', $id);
        
        $where->between('gmtcusdate', $onedayago, $todayago);
        $select->where($where);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $two = $statement->execute()->count();
        //1
        $select = $this->sql->select();
        $select->group('cusid');
        $where=new Where();
        $where->equalTo('salnumber', $id);
        
        $where->between('gmtcusdate', $todayago, $nowValue);
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