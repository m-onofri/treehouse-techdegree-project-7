<?php
// Routes

$app->group('/api/v1/todos', function() use($app) {
    $app->get('', function ($request, $response, $args) {
        $result = $this->task->getTasks();
        return $response->withJson($result, 200, JSON_PRETTY_PRINT);
    });
    $app->post('', function ($request, $response, $args) {
        $result = $this->task->createTask($request->getParsedBody());
        return $response->withJson($result, 201, JSON_PRETTY_PRINT);
    });
    $app->put('/{id}', function ($request, $response, $args) {
        $data = $request->getParsedBody();
        $data['task_id'] = $args['id'];
        $result = $this->task->updateTask($data);
        return $response->withJson($result, 201, JSON_PRETTY_PRINT);
    });
    $app->delete('/{id}', function ($request, $response, $args) {
        $result = $this->task->deleteTask($args['id']);
        return $response->withJson($result, 200, JSON_PRETTY_PRINT);
    });
});