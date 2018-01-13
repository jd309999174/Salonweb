<?php
namespace Checklist\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

class Task1Controller extends AbstractActionController
{

    public function indexAction()
    {
       
        return new ViewModel();
    }
}
