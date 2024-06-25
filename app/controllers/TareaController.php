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
        //$tareas = $this->tareaModel->createTarea("Tarea1", "Descripción1", "acabado", '2003-12-31 12:00:00', '2003-12-31 12:00:00', 1);
        //$tareas = $this->tareaModel->createTarea("Tarea2", "Descripción2", "empezado", '2003-12-31 12:00:00', '2003-12-31 12:00:00', 2);
        $tareas = $this->tareaModel->getAllTareas();
        print_r($this->tareaModel->getTareaById(1));
        $this->view->__set("tareas", $tareas);
        //print_r( $this->tareaModel->getTareaById(1));
        //print_r( $this->tareaModel->getTareaById(2));
        include 'scripts/tarea/index.phtml';
    }

    public function crearAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $estado = $_POST['estado'];
            $hora_inicio = $_POST['hora_inicio'];
            $hora_fin = $_POST['hora_fin'];
            $usuario = $_POST['usuario'];
            $this->tareaModel->createTarea($titulo, $descripcion, $estado, $hora_inicio, $hora_fin, $usuario);
            header('Location: index.phtml');
        } else {
            //include 'views/scripts/tarea/crear.phtml';
        }
    }

    public function editarAction($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        }
    }

    public function mostrarAction($id)
    {
        $tarea = $this->tareaModel->getTareaById($id);
        include 'views/scripts/tarea/mostrar.php';
    }

    public function borrarAction($id)
    {
        $this->tareaModel->deleteTarea($id);
        header('Location: index.php');
    }
}
?>