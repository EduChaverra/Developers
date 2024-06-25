<?php

class Tarea
{
    private $db;

    public function __construct()
    {
        require '../config/db.inc.php';
        $this->db = $dbh;
    }

    public function createTarea($titulo, $descripcion, $estado, $hora_inicio, $hora_fin, $usuario)
    {
        $stmt = $this->db->prepare("INSERT INTO todo_db.tareas (titulo, descripcion, estado, hora_inicio, hora_fin, usuario, creado_en) VALUES (:titulo, :descripcion, :estado, :hora_inicio, :hora_fin, :usuario, NOW())");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':hora_inicio', $hora_inicio);
        $stmt->bindParam(':hora_fin', $hora_fin);
        $stmt->bindParam(':usuario', $usuario);
        return $stmt->execute();
    }

    public function getAllTareas()
    {
        $stmt = $this->db->prepare("SELECT * FROM todo_db.tareas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getTareaById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM todo_db.tareas WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTarea($id, $titulo, $descripcion, $estado, $hora_inicio, $hora_fin, $usuario)
    {
        $stmt = $this->db->prepare("UPDATE todo_db.tareas SET titulo = :titulo, descripcion = :descripcion, estado = :estado, hora_inicio = :hora_inicio, hora_fin = :hora_fin, usuario = :usuario WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':hora_inicio', $hora_inicio);
        $stmt->bindParam(':hora_fin', $hora_fin);
        $stmt->bindParam(':usuario', $usuario);
        return $stmt->execute();
    }

    public function deleteTarea($id)
    {
        $stmt = $this->db->prepare("DELETE FROM todo_db.tareas WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>