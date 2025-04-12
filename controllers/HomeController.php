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

    public function getSanPhamTheoDanhMuc()
    {
        $danhMucId = $_GET['id'] ?? null;
        if ($danhMucId) {
            $listSanPham = $this->modelSanPham->getSanPhamByDanhMuc($danhMucId);
            echo json_encode($listSanPham);
        } else {
            echo json_encode([]);
        }
    }

    public function viewDetail()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $sanPham = $this->modelSanPham->getSanPhamById($id);
            if ($sanPham) {
                require_once './views/main/detail.php';
            } else {
                header('Location: ./');
                exit;
            }
        } else {
            header('Location: ./');
            exit;
        }
    }
}
