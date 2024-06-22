<?php

// echo "Hello"; (Testa para saber si esta redirigiendo bien la ruta... si lo hace!!!)

class TareaController extends Controller
{
    private $tareaModel;

    public function __construct()
    {
        $this->tareaModel = new Tarea();
    }

    public function index()
    {
        $tareas = $this->tareaModel->getAllTareas();
        include 'views/tareas/index.php';
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $estado = $_POST['estado'];
            $hora_inicio = $_POST['hora_inicio'];
            $hora_fin = $_POST['hora_fin'];
            $usuario = $_POST['usuario'];
            $this->tareaModel->createTarea($titulo, $descripcion, $estado, $hora_inicio, $hora_fin, $usuario);
            header('Location: index.php');
        } else {
            include 'views/tareas/crear.php';
        }
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $estado = $_POST['estado'];
            $hora_inicio = $_POST['hora_inicio'];
            $hora_fin = $_POST['hora_fin'];
            $usuario = $_POST['usuario'];
            $this->tareaModel->updateTarea($id, $titulo, $descripcion, $estado, $hora_inicio, $hora_fin, $usuario);
            header('Location: index.php');
        } else {
            $tarea = $this->tareaModel->getTareaById($id);
            include 'views/tareas/editar.php';
        }
    }

    public function mostrar($id)
    {
        $tarea = $this->tareaModel->getTareaById($id);
        include 'views/tareas/mostrar.php';
    }

    public function borrar($id)
    {
        $this->tareaModel->deleteTarea($id);
        header('Location: index.php');
    }
}
?>