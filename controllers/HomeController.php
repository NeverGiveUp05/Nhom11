<?php

class HomeController
{
    private $modelSanPham;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
    }

    public function home()
    {
        echo 'home';
    }

    public function trangChu()
    {
        echo 'trang chu';
    }

    public function danhSachSanPham()
    {
        $listProduct = $this->modelSanPham->getAllProduct();
        var_dump($listProduct);
    }
}
