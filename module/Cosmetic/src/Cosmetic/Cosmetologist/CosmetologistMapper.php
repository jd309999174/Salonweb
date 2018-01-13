<?php
namespace Cosmetic\Cosmetologist;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class CosmetologistMapper
{
    protected $tableName="cosmetologist";
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
        $select=$this->sql->select();
        
        $statement=$this->sql->prepareStatementForSqlObject($select);
        $results=$statement->execute();
        
        $entityPrototype=new CosmetologistEntity();
        $hydrator=new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
        
    }
    
    public function saveCosmetologist(CosmetologistEntity $cosmetologist)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($cosmetologist);
    
        if ($cosmetologist->getCosid()) {
            // update action
            $action = $this->sql->update();
            $action->set($data);
            $action->where(array('cosid' => $cosmetologist->getCosid()));
        } else {
            // insert action
            $action = $this->sql->insert();
            unset($data['cosid']);
            $action->values($data);
        }
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$cosmetologist->getCosid()) {
            $cosmetologist->setCosid($result->getGeneratedValue());
        }
        return $result;
    
    }
    //保存最近评星update
    public function saveRecentstar($cosid,$recentstar){
        $update=$this->sql->update();
        $update->set(array("recentstar"=>$recentstar));
        $update->where(array('cosid' => $cosid));
        $statement = $this->sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();
        return $result;
    }
    
    //按美容院编号查
    public function getCosmetologist($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new CosmetologistEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //按美容院编号和分院号查
    public function getCosmetologistBranch($id,$sub)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id,'salbranch'=>$sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new CosmetologistEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    public function getCosmetologist1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('cosid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();
        if (!$result) {
            return null;
        }
    
        $hydrator = new ClassMethods();
        $cosmetologist = new CosmetologistEntity();
        $hydrator->hydrate($result, $cosmetologist);
    
        return $cosmetologist;
    }
    //登陆
    public function getCosmetologistlogin($cosphone,$cospassword)
    {
        $select = $this->sql->select();
        $select->where(array('cosphone' => $cosphone,'cospassword'=>$cospassword));
    
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();
        if (!$result) {
            return null;
        }
    
        $hydrator = new ClassMethods();
        $cosmetologist = new CosmetologistEntity();
        $hydrator->hydrate($result, $cosmetologist);
    
        return $cosmetologist;
    }
    
    //总店长
    public function getSalonmanager($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' => $id,'cosposition'=>"总店长"));
        $select->limit(1);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute()->current();
        if (!$result) {
            return null;
        }
    
        $hydrator = new ClassMethods();
        $cosmetologist = new CosmetologistEntity();
        $hydrator->hydrate($result, $cosmetologist);
    
        return $cosmetologist;
    }
   
    public function deleteCosmetologist($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('cosid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}