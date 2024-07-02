<?php

class Tarea extends Model
{
    protected $_file = '/Users/eduardochaverra/Documents/IT Academy/Developers/data/tareas.json';

    public function fetchAll()
    {
        $json = file_get_contents($this->_file);
        return json_decode($json) ?: []; // Retornar un array vacío si el JSON está vacío o inválido
    }

    public function fetchOne($id)
    {
        $tareas = $this->fetchAll();
        foreach ($tareas as $tarea) {
            if ($tarea->id == $id) {
                return $tarea;
            }
        }
        return null;
    }

    public function save($data = array())
    {
        $tareas = $this->fetchAll();

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

    public function delete($id)
    {
        $tareas = $this->fetchAll();
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