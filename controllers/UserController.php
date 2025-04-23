<?php

class UserController
{
    private $modelUser;

    public function __construct()
    {
        $this->modelUser = new User();
    }

    public function register()
    {
        require_once './views/main/register.php';
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

    public function handleRegister()
    {
        $email = $_POST['email'];
        $matKhau = $_POST['mat_khau'];
        $hoTen = $_POST['ho_ten'];
        $soDienThoai = $_POST['so_dien_thoai'];
        $diaChi = $_POST['dia_chi'];
        $ngaySinh = formatDateDB($_POST['ngay_sinh']);
        $gioiTinh = $_POST['gioi_tinh'] ?? null;

        if ($this->modelUser->checkAccount($email, $soDienThoai)) {
            $_SESSION['resultRegister'] = 'error';
            header('Location: ?act=register');
            return;
        }

        $hinh_anh = $_FILES['anh_dai_dien'] ?? null;
        $anhDaiDien = uploadFile($hinh_anh, './uploads/');

        $user = $this->modelUser->register($hoTen, $anhDaiDien, $ngaySinh, $email, $soDienThoai, $gioiTinh, $diaChi, $matKhau);

        $_SESSION['user']['role'] = $this->modelUser->getRole($user['chuc_vu_id']);
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['name'] = $user['ho_ten'];
        $_SESSION['user']['anh_dai_dien'] = $user['anh_dai_dien'];
        $_SESSION['resultRegister'] = 'success';

        header('Location: ?act=register');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: ./');
    }
}
