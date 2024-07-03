<?php

class Tarea extends Model
{
    protected $_file = ROOT_PATH . '/data/tareas.json';

    public function fetchAllTarea()
    {
        $json = file_get_contents($this->_file);
        return json_decode($json) ?: []; // Retornar un array vacío si el JSON está vacío o inválido
    }

    public function fetchOneTarea($id)
    {
        
        $tareas = $this->fetchAllTarea();
        foreach ($tareas as $tarea) {
            if ($tarea->id == $id) {
                return $tarea;
            }
        }
        return null;
    }

    public function saveTarea($data = array())
    {
        $tareas = $this->fetchAllTarea();

        if (empty($tareas)) {
            $tareas = [];
            $maxId = 0;
        } else {
            $maxId = max(array_column($tareas, 'id'));
        }
        
        if (isset($data['id'])) {
            foreach ($tareas as $key => $tarea) {
                if ($tarea->id == $data['id']) {
                    $tareas[$key] = (object) $data;
                    break;
                }
            }
        } else {
            $data['id'] = $maxId + 1;
            $tareas[] = (object) $data;
        }

        $json = json_encode($tareas, JSON_PRETTY_PRINT);
        file_put_contents($this->_file, $json);
        return true;
    }


    /*public function updateTarea($data = array())
    public function getTareaByState($state)
    {
        $stmt = $this->db->prepare("SELECT * FROM todo_db.tareas WHERE estado = :state");
        $stmt->bindParam(':state', $state, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }*/

    public function updateTarea($id, $titulo, $descripcion, $estado, $hora_inicio, $hora_fin, $usuario)
    {
        $tareas = $this->fetchAllTarea();
    }

    public function deleteTarea($id)
    {
        $tareas = $this->fetchAllTarea();
        foreach ($tareas as $key => $tarea) {
            if ($tarea->id == $id) {
                unset($tareas[$key]);
                break;
            }
        }
        $json = json_encode(array_values($tareas), JSON_PRETTY_PRINT);
        file_put_contents($this->_file, $json);
        return true;
    }
}

?>