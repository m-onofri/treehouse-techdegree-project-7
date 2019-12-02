<?php

namespace App\Model;

class Subtask
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getSubtasks($task_id)
    {
        $statement = $this->database->prepare(
            'SELECT * FROM subtasks WHERE task_id = :task_id'
        );
        $statement->bindParam('task_id', $task_id);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getSubtask($task_id, $subtask_id)
    {
        $statement = $this->database->prepare(
            'SELECT * FROM subtasks WHERE task_id = :task_id AND id = :id'
        );
        $statement->bindParam('task_id', $task_id);
        $statement->bindParam('id', $subtask_id);
        $statement->execute();

        return $statement->fetch();
    }

    public function createSubtask($data)
    {
        $statement = $this->database->prepare(
            'INSERT INTO subtasks(name, status, task_id) VALUES (:name, :status, :task_id)'
        );
        $statement->bindParam('name', $data['name']);
        $statement->bindParam('status', $data['status']);
        $statement->bindParam('task_id', $data['task_id']);
        $statement->execute();

        return $this->getSubtask($data['task_id'], $this->database->lastInsertId());
    }

    public function updateSubtask($data)
    {
        $statement = $this->database->prepare(
            'UPDATE subtasks SET name=:name, status=:status, task_id=:task_id WHERE id=:id'
        );
        $statement->bindParam('name', $data['name']);
        $statement->bindParam('status', $data['status']);
        $statement->bindParam('task_id', $data['task_id']);
        $statement->bindParam('id', $data['subtask_id']);
        $statement->execute();

        return $this->getSubtask($data['task_id'], $data['subtask_id']);
    }

    public function deleteSubtask($task_id, $subtask_id)
    {
        $statement = $this->database->prepare(
            'DELETE FROM subtasks WHERE task_id = :task_id AND id = :id'
        );
        $statement->bindParam('task_id', $task_id);
        $statement->bindParam('id', $subtask_id);
        $statement->execute();

        return ['message' => 'The subtask was deleted!'];
    }
}