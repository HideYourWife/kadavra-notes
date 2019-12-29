<?php


namespace Controllers;


use App\Controller;
use Models\User;

class auth extends Controller
{
    public function index()
    {
        session_start();
        if ($_SESSION['name'] == 'admin') {
            $is_auth = true;
        }
        session_write_close();

        return $this->render('auth', compact('is_auth'));
    }


    public function login()
    {
        if (empty($_POST['name']) || empty($_POST['password']))
            exit('Wrong user name or password');

        $users = new User('users');
        $user = array_shift($users->getName($_POST['name']));

        if (empty($user))
            exit('Wrong login');

        if ($user['password'] != $_POST['password'])
            exit('Wrong password');


        session_start();
        $_SESSION['name'] = 'admin';
        session_write_close();

        header("Location: /auth");
        return $this->index();
    }

    public function logout()
    {
        session_start();
        $_SESSION['name'] = null;
        session_write_close();

        header("Location: /auth");
        return $this->index();
    }
}