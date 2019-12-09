<?php

// Endpoints list
$app->get('/', function ($request, $response, $args) {
    $endpoints = [
        'all tasks' => $this->api['api_url'].'/todos',
        'single task' => $this->api['api_url'].'/todos/{task_id}',
        'subtasks by task' => $this->api['api_url'].'/todos/{task_id}/subtasks',
        'single subtask' => $this->api['api_url'].'/todos/{task_id}/subtasks/{subtask_id}',
        'help' => $this->api['base_url'].'/', 
    ];
    $result = [
        'version' => $this->api['version'],
        'timestamp' => time(),
        'endpoints' => $endpoints,
    ];
    return $response->withJson($result, 200, JSON_PRETTY_PRINT);
});

$app->group('/api/v1/todos', function() use($app) {
    // Get all the tasks
    $app->get('', function ($request, $response, $args) {
        $result = $this->task->getTasks();
        return $response->withJson($result, 200, JSON_PRETTY_PRINT);
    });
    // Get a specific task
    $app->get('/{task_id}', function ($request, $response, $args) {
        $result = $this->task->getTask($args['task_id']);
        return $response->withJson($result, 200, JSON_PRETTY_PRINT);
    });
    // Add a new task and return the new added task
    $app->post('', function ($request, $response, $args) {
        $result = $this->task->createTask($request->getParsedBody());
        return $response->withJson($result, 201, JSON_PRETTY_PRINT);
    });
    // Update a specific task and return the updated task
    $app->put('/{task_id}', function ($request, $response, $args) {
        $data = $request->getParsedBody();
        $data['task_id'] = $args['task_id'];
        $result = $this->task->updateTask($data);
        return $response->withJson($result, 201, JSON_PRETTY_PRINT);
    });
    // Delete a specific task and return a related message
    $app->delete('/{task_id}', function ($request, $response, $args) {
        $result = $this->task->deleteTask($args['task_id']);
        return $response->withJson($result, 200, JSON_PRETTY_PRINT);
    });
    $app->group('/{task_id}/subtasks', function() use($app) {
        // Get all the subtasks associated with a specific task
        $app->get('', function ($request, $response, $args) {
            $result = $this->subtask->getSubtasks($args['task_id']);
            return $response->withJson($result, 200, JSON_PRETTY_PRINT);
        });
        // Get a specific subtask associated with a specific task
        $app->get('/{subtask_id}', function ($request, $response, $args) {
            $result = $this->subtask->getSubtask($args['task_id'], $args['subtask_id']);
            return $response->withJson($result, 200, JSON_PRETTY_PRINT);
        });
        // Add a new subtask to a specific task
        $app->post('', function ($request, $response, $args) {
            $data = $request->getParsedBody();
            $data['task_id'] = $args['task_id'];
            $result = $this->subtask->createSubtask($data);
            return $response->withJson($result, 201, JSON_PRETTY_PRINT);
        });
        // Update a specific subtask associated with a specific task
        $app->put('/{subtask_id}', function ($request, $response, $args) {
            $data = $request->getParsedBody();
            $data['task_id'] = $args['task_id'];
            $data['subtask_id'] = $args['subtask_id'];
            $result = $this->subtask->updateSubtask($data);
            return $response->withJson($result, 201, JSON_PRETTY_PRINT);
        });
        // Delete a specific subtasks associated with a specific task
        $app->delete('/{subtask_id}', function ($request, $response, $args) {
            $result = $this->subtask->deleteSubtask($args['task_id'], $args['subtask_id']);
            return $response->withJson($result, 200, JSON_PRETTY_PRINT);
        });
    });
});