<?php
namespace Decorate\Template;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\ResultSet\HydratingResultSet;
class TemplateMapper
{
    protected $tableName="templateitems";
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

        $entityPrototype = new TemplateEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    
    public function saveTemplate(TemplateEntity $template)
    {
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($template);
    
       
            // insert action
            $action = $this->sql->insert();
            
            $action->values($data);
        
        $statement = $this->sql->prepareStatementForSqlObject($action);
        $result = $statement->execute();
    
        if (!$template->getTemplateid()) {
            $template->setTemplateid($result->getGeneratedValue());
        }
        return $result;
    }
    //按美容院id,产品id，获取产品详情模块
    public function getProductdetail($id,$sub)
    {
        $select = $this->sql->select();
        $select->where(array('prodid' => $sub));
        $select->order(array('templateindex ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new TemplateEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //取得次页面有所模块
    public function getTemplate($sub)
    {
        $select = $this->sql->select();
        $select->where(array('pageid' => $sub));
        $select->order(array('templateindex ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new TemplateEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //取得此美容院和公司所有促销活动
    public function getTemplate2($id)
    {
        $select = $this->sql->select();
        $select->where(array('salnumber' =>array($id,0)));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        if (!$results) {
            return null;
        }
    
    
        $entityPrototype = new TemplateEntity();
        $hydrator = new ClassMethods();
        $resultset = new HydratingResultSet($hydrator, $entityPrototype);
        $resultset->initialize($results);
        return $resultset;
    }
    //按ID取得单个模块
    public function getTemplate1($sub)
    {
        $select = $this->sql->select();
        $select->where(array('templateid' => $sub));
        //$select->order(array('salid ASC', 'salnumber ASC'));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute()->current();
        if (!$results) {
            return null;
        }
    
    
          $hydrator = new ClassMethods();
          $salon = new TemplateEntity();
          $hydrator->hydrate($results, $salon);
 
          return $salon;
    }
    //删除页面
    public function deleteTemplate($sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('pageid' => $sub));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    //删除此美容院下次产品所有模块
    public function deleteTemplate1($id,$sub)
    {
        $delete = $this->sql->delete();
        $delete->where(array('prodid' => $sub,'salnumber'=>$id));
    
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        return $statement->execute();
    }
    
}