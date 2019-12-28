<?php


namespace Controllers;

use App\Controller;
use Models\Task;

class Home extends Controller
{

    public function index ($errors = false)
    {
        $task = new Task('tasks');
        $allTasks = $task->getAll();
        $params = [
            'tasks' => $allTasks,
            'errors' => $errors,
        ];
        return $this->render('Home', $params);
    }


    public function create()
    {
        $errors = [];
        $data = [
            'name' => trim(htmlspecialchars($_POST['name'])),
            'email' => trim(htmlspecialchars($_POST['email'])),
            'text' => trim(htmlspecialchars($_POST['text']))
        ];
        if (empty($data['name']) || empty($data['email']) || empty($data['text'])) {
            $data['name'] ? null : $errors[] = "Не заполнено поле имя";
            $data['email'] ? null : $errors[] = "Не заполнено поле email";
            $data['text'] ? null : $errors[] = "Не заполнено поле text";
        }
        $task = new Task('tasks');
        $task->create($data);

        header("Location: /home");
        $this->index($errors);
    }

}