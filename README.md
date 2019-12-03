# treehouse-techdegree-project-7

The goal of this project is to create a REST API using Slim Framework 3 and SQLite database.
The API will provide a way for users to manage a todo list.
To test your application, you can use Postman, a popular application for exploring and testing REST APIs.

## How to install 

Clone the git repository in the folder of your choice:
```
git clone https://github.com/m-onofri/treehouse-techdegree-project-7.git
```

Install the packages:
```
cd treehouse-techdegree-project-7
composer install
```

Run the server:
```
cd public
php -S localhost:4000
```

In your browser, go to http://localhost:4000/ and give a look at the available API endpoints.

 ## Available routes

* For tasks:
    - **[GET] /api/v1/todos**: fetch all the available tasks
    - **[POST] /api/v1/todos**: create a new task
    - **[GET] /api/v1/todos/{task_id}**: fetch a single specific task
    - **[PUT] /api/v1/todos/{task_id}**: update a single specific task
    - **[DELETE] /api/v1/todos/{task_id}**: delete a single specific task

* For subtasks:
    - **[GET] /api/v1/todos/{task_id}/subtasks**: fetch all the available tasks
    - **[POST] /api/v1/todos/{task_id}/subtasks**: create a new task
    - **[GET] /api/v1/todos/{task_id}/subtasks/{subtask_id}**: fetch a single specific task
    - **[PUT] /api/v1/todos/{task_id}/subtasks/{subtask_id}**: update a single specific task
    - **[DELETE] /api/v1/todos/{task_id}/subtasks/{subtask_id}**: delete a single specific task

## Code organization

* The Slim Framework 3 was quickly setup using a [**skeleton application**](https://github.com/slimphp/Slim-Skeleton). 
* In the **'public'** folder you can find the index.php file;
* In the **'src'** folder you can find:
    - the subfolder **Model** containing the **Task** and **Subtask** classes, responsible for managing the data of the application;
    - the subfolder **Exception** containing the **ApiException** class, responsible for managing exceptions;
    - the **routes.php** file with all the routes of the project;
    - the **todo.db** database.

## Cross-browser consistency

The project was checked on MacOS in Chrome, Firefox, Opera and Safari, and on these browsers it works properly.

