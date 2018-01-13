<?php
namespace Checklist\Controller;

use Checklist\Model\TaskEntity;
use Checklist\Form\TaskForm;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

class TaskController extends AbstractActionController
{

    public function indexAction()
    {
        $mapper1 = $this->getTaskMapper();
        return new ViewModel(array( 
            'tasks1' => $mapper1->fetchAll()
        ));
    }

    public function addAction()
    {
        $form = new TaskForm();
        $task = new TaskEntity();
        $form->bind($task);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getTaskMapper()->saveTask($task);
                
                // Redirect to list of tasks
                return $this->redirect()->toRoute('task1');
            }
        }
        
        return array(
            'form' => $form
        );
    }
    
    public function editAction()
    {
        $id = (int)$this->params('id');
        if (!$id) {
            return $this->redirect()->toRoute('task', array('action'=>'add'));
        }
        $task = $this->getTaskMapper()->getTask($id);
    
        $form = new TaskForm();
        $form->bind($task);
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getTaskMapper()->saveTask($task);
    
                return $this->redirect()->toRoute('task');
            }
        }
    
        return array(
            'id' => $id,
            'form' => $form,
        );
    }
    
    public function deleteAction()
    {
        $id = $this->params('id');
        $task = $this->getTaskMapper()->getTask($id);
        if (!$task) {
            return $this->redirect()->toRoute('task');
        }
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getTaskMapper()->deleteTask($id);
            }
    
            return $this->redirect()->toRoute('task');
        }
    
        return array(
            'id' => $id,
            'task' => $task
        );
    }

    public function databaseAction(){
        return new ViewModel();
    }
    public function getTaskMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('TaskMapper');
    }
}
