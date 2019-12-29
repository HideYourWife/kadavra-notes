<?php


namespace Controllers;

use App\Controller;
use Models\Task;

class Home extends Controller
{

    public function index ()
    {
        $task = new Task('tasks');

        if (isset($_GET['PAG'])) {
            $current_page = $_GET['PAG'] ? (int)trim($_GET['PAG']) : 0;
        }

        session_start();

        if ($_SESSION['name'] == 'admin') {
            $is_auth = true;
        }

        $msg = htmlspecialchars($_GET['msg']);

        /* This ugly block for sorting control */
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


        $allTasks = $task->pagen($current_page, $order_by, $modifier);
        $count = $task->getCount();
        $pages = ceil($count / PAGINATION);
        $params = [
            'tasks' => $allTasks,
            'msg' => $msg,
            'count' => $count,
            'pages' => $pages,
            'current_page' => $current_page,
            'is_auth' => $is_auth,
        ];
        session_write_close();

        return $this->render('Home', $params);
    }


    public function create()
    {
        $data = [
            'name' => trim(htmlspecialchars($_POST['name'])),
            'email' => trim(htmlspecialchars($_POST['email'])),
            'text' => trim(htmlspecialchars($_POST['text']))
        ];
        if (empty($data['name']) || empty($data['email']) || empty($data['text'])) {
            $msg = 'Не все поля заполнены';
        }
        $task = new Task('tasks');
        $task->create($data);

        if (!$msg)
            $msg = 'Запись удачно сохранена';

        header("Location: /home?msg=$msg");
        $this->index();
    }


    public function edit($errors = false)
    {
        if (!isset($_GET['id']) || empty($_GET['id']) || !is_int((int)trim($_GET['id']))) die;

        $id = (int)trim(htmlspecialchars($_GET['id']));
        $task = new Task('tasks');
        $cur_task = array_shift($task->getId($id));

        $params = [
            'task' => $cur_task,
            'errors' => $errors,
        ];

        return $this->render('edit', $params);
    }


    public function update()
    {
        session_start();
        if ($_SESSION['name'] != 'admin') {
            exit('You need to be authorized for this');
        }
        session_write_close();

        if (!isset($_POST['id']) || empty($_POST['id']) || !is_int((int)trim($_POST['id']))) {
            $msg = 'Wrong or empty ID';
            $this->edit($errors);
        }

        $id = (int)trim(htmlspecialchars($_POST['id']));
        $task = new Task('tasks');
        $cur_task = array_shift($task->getId($id));

        if ($cur_task['text'] != trim(htmlspecialchars($_POST['text']))) {
            $cur_task['text'] = trim(htmlspecialchars($_POST['text']));
            $cur_task['updated_at'] = date('d.m.Y');
        }

        $cur_task['resolved'] = $_POST['resolved'] == 'on' ? 1 : null;

        $task->update($cur_task);

        if (!$msg)
            $msg = 'Изменения сохранены';

        header("Location: /home?msg=$msg");
        $this->index();
    }

}