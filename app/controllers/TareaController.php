<?php

// echo "Hello"; (Testa para saber si esta redirigiendo bien la ruta... si lo hace!!!)

class TareaController extends Controller
{
    private $tareaModel;

    public function __construct()
    {
        $this->tareaModel = new Tarea();
    }

    public function indexAction()
    {
        //$tareas = $this->tareaModel->createTarea("Tarea1", "Descripción1", "pendiente", '2003-12-31 12:00:00', '2003-12-31 12:00:00', 1);
        //$tareas = $this->tareaModel->createTarea("Tarea2", "Descripción2", "empezado", '2003-12-31 12:00:00', '2003-12-31 12:00:00', 2);
        $tareas = $this->tareaModel->getAllTareas();
        //print_r($this->tareaModel->getTareaById(1));
        //$this->crearAction();
        //$this->crearAction();
        $this->view->__set("tareas", $tareas);
    }

    public function createAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $estado = $_POST['estado'];
            $hora_inicio = !empty($_POST['hora_inicio']) ? $_POST['hora_inicio'] : null;
            $hora_fin = !empty($_POST['hora_fin']) ? $_POST['hora_fin'] : null;
            $usuario = $_POST['usuario'];

            if ($this->tareaModel->createTarea($titulo, $descripcion, $estado, $hora_inicio, $hora_fin, $usuario)) {
                header('Location: ' . WEB_ROOT . '/');
                exit("Nueva tarea creada con éxito");
            } else {
                exit("Error al crear la tarea");
            }
        } else {
            //include 'views/create.phtml';
        }
    
    }

    public function readAction($id)
    {
        $tarea = $this->tareaModel->getTareaById($id);
        include 'views/scripts/tarea/mostrar.php';
    }

    /*public function updateAction($id)
    {
        $tarea = $this->tareaModel->getTareaById($id);
    }*/

    public function updateAction()
    {
        /*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $estado = $_POST['estado'];
            $hora_inicio = $_POST['hora_inicio'];
            $hora_fin = $_POST['hora_fin'];
            $usuario = $_POST['usuario'];
            $this->tareaModel->updateTarea($id, $titulo, $descripcion, $estado, $hora_inicio, $hora_fin, $usuario);
            header('Location: index.phtml');
        } else {
            $tarea = $this->tareaModel->getTareaById($id);
            include 'views/scripts/tarea/editar.phtml';
        }*/
        $tareas = $this->tareaModel->getAllTareas();
        $idUpdate = $this->_getParam('id');
        $currentTarea = $this->tareaModel->getTareaById($idUpdate);
        $this->view->__set("tareas", $tareas);
        $this->view->__set("currentTarea", $currentTarea);
    }

    

    public function deleteAction()
    {
        $tareas = $this->tareaModel->getAllTareas();
        $idDelete = $this->_getParam('id');
        $this->tareaModel->deleteTarea($idDelete);
        header('Location: ' . WEB_ROOT . '/');
    }
}
?>