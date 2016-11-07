<?php

class UserController extends Controller
{
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->model = new User();
    }

    public function index()
    {

    }

    public function admin_login()
    {
        if($_POST && is($_POST, 'login') && is($_POST, 'password')) {
            $login = trim($_POST['login']);
            $hash = $_POST['password'];
            $user = $this->model->getByLogin($login, $hash);
            if($user && $user['is_active'] ==1) {
                Session::set('login', $user['login']);
                Session::set('role', $user['role']);
            }
            Router::redirect('/admin/event/index');
        }
    }

    public function admin_logout()
    {
        Session::destroy();
        Router::redirect('/admin');
    }
}
