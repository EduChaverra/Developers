<?php

class TareaController extends Controller
{
    protected $_model;

    public function init()
    {
        parent::init();
        $this->_model = new Tarea();
    }

    public function indexAction()
    {
        $this->view->tareas = $this->_model->fetchAll();
    }

    public function createAction()
    {
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getAllParams();
            $this->_model->save($data);
            header('Location: ' . WEB_ROOT . '/');
        }
    }

    public function showAction()
    {
        $id = $this->_getParam('id');
        $this->view->tarea = $this->_model->fetchOne($id);
    }

    public function updateAction()
    {
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getAllParams();
            $this->_model->save($data);
            header('Location: ' . WEB_ROOT . '/');
        } else {
            $id = $this->_getParam('id');
            $this->view->tarea = $this->_model->fetchOne($id);
        }
    }

    public function deleteAction()
    {
        $id = $this->_getParam('id');
        $this->_model->delete($id);
        header('Location: ' . WEB_ROOT . '/');
    }
}

?>