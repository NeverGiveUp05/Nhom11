<?php

class UserController
{
    private $modelUser;

    public function __construct()
    {
        $this->modelUser = new User();
    }

    public function login()
    {
        require_once './views/main/login.php';
    }

    public function handleLogin()
    {
        $account = $_POST['account'];
        $password = $_POST['password'];

        $result = $this->modelUser->login($account, $password);

        if (!$result || $result['trang_thai'] == 0) {
            $_SESSION['resultLogin'] = 'error';
            header('Location: ?act=login');
            return;
        }

        $_SESSION['user']['role'] = $this->modelUser->getRole($result['chuc_vu_id']);
        $_SESSION['user']['id'] = $result['id'];
        $_SESSION['user']['name'] = $result['ho_ten'];
        $_SESSION['user']['anh_dai_dien'] = $result['anh_dai_dien'];
        header('Location: ./');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: ./');
    }
}
