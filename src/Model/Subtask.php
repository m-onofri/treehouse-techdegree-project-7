<?php

namespace App\Model;

class Subtask
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getSubtasksByTaskId($task_id)
    {
        $statement = $this->database->prepare(
            'SELECT * FROM subtasks WHERE task_id = :task_id'
        );
        $statement->bindParam('task_id', $task_id);
        $statement->execute();

        return $statement->fetchAll();
    }
}