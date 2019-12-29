<?php


namespace Controllers;


use App\Controller;
use Models\User;

class Auth extends Controller
{
    public function index()
    {
        $msg = htmlspecialchars($_GET['msg']);

        session_start();
        if ($_SESSION['name'] == 'admin') {
            $is_auth = true;
        }
        session_write_close();

        return $this->render('auth', compact('is_auth', 'msg'));
    }


    public function login()
    {
        if (empty($_POST['name']) || empty($_POST['password']))
            return header("Location: /auth?msg=Заполнены не все поля");

        $users = new User('users');
        $user = array_shift($users->getName($_POST['name']));

        if (empty($user))
            return header("Location: /auth?msg=Пользователь с таким именем не существует");

        if ($user['password'] != $_POST['password'])
            return header("Location: /auth?msg=Неверный пароль");


        session_start();
        $_SESSION['name'] = 'admin';
        session_write_close();

        return header("Location: /auth");
    }

    public function logout()
    {
        session_start();
        $_SESSION['name'] = null;
        session_write_close();

        return header("Location: /auth");
    }
}