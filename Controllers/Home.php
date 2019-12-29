<?php


namespace Controllers;

use App\Controller;
use Models\Task;

class Home extends Controller
{

    public function index ($errors = false)
    {
        $task = new Task('tasks');

        if (isset($_GET['PAG'])) {
            $current_page = $_GET['PAG'] ? (int)trim($_GET['PAG']) : 0;
        }

        /* This ugly block for sorting control */
        session_start();
        if (isset($_POST['sort']) && !empty($_POST['sort'])) {
            $_SESSION['sort'] = trim(htmlspecialchars($_POST['sort']));

            if (isset($_SESSION['modifier']) || !empty($_SESSION['modifier'])) {
                $_SESSION['modifier'] == 'ASC' ? $_SESSION['modifier'] = 'DESC' : $_SESSION['modifier'] = 'ASC';
            } else $_SESSION['modifier'] = 'ASC';

            $parts = parse_url($_SERVER['HTTP_REFERER']);
            parse_str($parts['query'], $query);
            if (isset($query['PAG']) && !empty($query['PAG'])) {
                $current_page = (int)trim(htmlspecialchars($query['PAG']));
            }
        }
        $order_by = $_SESSION['sort'] ?? 'id';
        $modifier = $_SESSION['modifier'] ?? 'ASC';
        session_write_close();


        $allTasks = $task->pagen($current_page, $order_by, $modifier);
        $count = $task->getCount();
        $pages = ceil($count / PAGINATION);
        $params = [
            'tasks' => $allTasks,
            'errors' => $errors,
            'count' => $count,
            'pages' => $pages,
            'current_page' => $current_page,
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


    public function update()
    {
        if (!isset($_GET['id']) || empty($_GET['id']) || !is_int((int)trim($_GET['id']))) die;

        $id = (int)trim(htmlspecialchars($_GET['id']));
        $task = new Task('tasks');
        $cur_task = $task->getId($id);

        print_r($cur_task);

    }

}