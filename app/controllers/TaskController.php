<?php

class TaskController extends ApplicationController
{
    public function indexAction()
    {  
        $taskModel = new Task();
        $this->view->tasks = $taskModel->getAllTasks();
    }

    public function viewAction()
    {
        $id = $this->_getParam('id');
        $taskModel = new Task();
        $this->view->task = $taskModel->getTask($id);
    }

    public function createAction()
    {
        if ($this->getRequest()->isPost()) {
            $taskData = $this->_getAllParams();
            $taskModel = new Task();
            $taskModel->createTask($taskData);
            header('Location: /task');
            exit;
        }
    }

    public function updateAction()
    {
        if ($this->getRequest()->isPost()) {
            $taskData = $this->_getAllParams();
            $taskModel = new Task();
            $taskModel->updateTask($taskData);
            header('Location: /task');
            exit;
        } else {
            $id = $this->_getParam('id');
            $taskModel = new Task();
            $this->view->task = $taskModel->getTask($id);
        }
    }

    public function deleteAction()
    {
        $id = $this->_getParam('id');
        $taskModel = new Task();
        $taskModel->deleteTask($id);
        header('Location: /task');
        exit;
    }
}

?>