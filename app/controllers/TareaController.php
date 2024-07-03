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

        $this->view->tareas = $this->_model->fetchAllTarea();
        $tareas = $this->view->tareas;
        //$tareas = $this->tareaModel->getAllTareas();

        
        if(count($tareas) > 0)
        {
            $tareasEnProgreso = [];
            $tareasPendiente = [];
            $tareasCompletado =[];

            foreach($tareas as $tarea)
            {
                switch($tarea->estado)
                {
                    case "pendiente":
                        array_push($tareasPendiente, $tarea);
                        break;
                    case "en_progreso":
                        array_push($tareasEnProgreso, $tarea);
                        break;
                    case "completada":
                        array_push($tareasCompletado, $tarea);
                        break;
                }
            }

            $this->view->__set("tareasPendiente", $tareasPendiente);
            $this->view->__set("tareasEnProgreso", $tareasEnProgreso);
            $this->view->__set("tareasCompletado", $tareasCompletado);
        }
        $this->view->__set("tareas", $tareas);
    }

    public function createAction()
    {
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getAllParams();
            $this->_model->saveTarea($data);
            header('Location: ' . WEB_ROOT . '/');
        }
    }

    public function showAction()
    {
        $id = $this->_getParam('id');
        $this->view->tarea = $this->_model->fetchOneTarea($id);
    }

    public function updateAction()
    {
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getAllParams();
            $this->_model->saveTarea($data);
            header('Location: ' . WEB_ROOT . '/');
        } else {
            $id = $this->_getParam('id');
            $this->view->tarea = $this->_model->fetchOneTarea($id);
        }
    }

    public function deleteAction()
    {
        $id = $this->_getParam('id');
        $this->_model->deleteTarea($id);
        header('Location: ' . WEB_ROOT . '/');
    }
}

?>