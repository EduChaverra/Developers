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
        if(count($tareas) > 0)
        {
            $tareasEnProgreso = [];
            $tareasPendiente = [];
            $tareasCompletado =[];

            foreach($tareas as $tarea)
            {
                switch($tarea["estado"])
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
        } 
    
    }

    public function readAction($id)
    {
        $tarea = $this->tareaModel->getTareaById($id);
        include 'views/scripts/tarea/mostrar.php';
    }


    public function showAction()
    {
        // Obtener el ID de la tarea a actualizar
        $idUpdate = $this->_getParam('id');
    
        // Obtener la tarea actual para pre-llenar el formulario
        $currentTarea = $this->tareaModel->getTareaById($idUpdate);
        
        // Pasar los datos a la vista
        $this->view->__set("currentTarea", $currentTarea);
    }
    
    public function updateAction()
    {
        $idUpdate = $this->_getParam('id');
    
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $estado = $_POST['estado'];
        $hora_inicio = !empty($_POST['hora_inicio']) ? $_POST['hora_inicio'] : null;
        $hora_fin = !empty($_POST['hora_fin']) ? $_POST['hora_fin'] : null;
        $usuario = $_POST['usuario'];
    
        if ($this->tareaModel->updateTarea($idUpdate, $titulo, $descripcion, $estado, $hora_inicio, $hora_fin, $usuario)) {
            header('Location: ' . WEB_ROOT . '/');
            exit("Tarea actualizada con éxito");
        } else {
            exit("Error al actualizar la tarea");
        }
    }

    

    public function deleteAction()
    {
        $tareas = $this->tareaModel->getAllTareas();
        $idDelete = $this->_getParam('id');
        $this->tareaModel->deleteTarea($idDelete);
        //header('Location: ' . WEB_ROOT . '/');
    }
}
?>