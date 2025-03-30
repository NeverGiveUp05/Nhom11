<?php
require_once './models/AdminDanhMuc.php';

class AdminDanhMucController
{
    private $modelDanhMuc;
    public function __construct()
    {
        $this->modelDanhMuc = new AdminDanhMuc;
    }
    public function danhSachDanhMuc()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/danhmuc/DanhMuc.php';
    }
}
