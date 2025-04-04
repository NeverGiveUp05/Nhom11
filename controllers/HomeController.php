<?php

class HomeController
{
    private $modelDanhMuc;
    private $modelSanPham;

    public function __construct()
    {
        $this->modelDanhMuc = new DanhMuc();
        $this->modelSanPham = new SanPham();
    }

    public function home()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        $firstDanhMuc = $this->modelDanhMuc->getFirstDanhMuc();
        $danhMucId = $firstDanhMuc['id'] ?? null;
        if ($danhMucId) {
            $listSanPham = $this->modelSanPham->getSanPhamByDanhMuc($danhMucId);
        } else {
            $listSanPham = [];
        }

        require_once './views/main/home.php';
    }

    public function trangChu()
    {
        echo 'trang chu';
    }
}
