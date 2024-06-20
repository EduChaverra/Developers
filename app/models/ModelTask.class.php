<?php
class Task extends Model
{
    protected $_table = 'tasks';

    public function getAllTasks()
    {
        $sql = 'SELECT * FROM ' . $this->_table;
        $statement = $this->_dbh->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function createTask($data)
    {
        return $this->save($data);
    }

    public function getTask($id)
    {
        return $this->fetchOne($id);
    }

    public function updateTask($data)
    {
        return $this->save($data);
    }

    public function deleteTask($id)
    {
        return $this->delete($id);
    }
}
?>