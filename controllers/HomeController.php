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
            $listSanPham = $this->modelSanPham->getSanPhamByDanhMucLM5($danhMucId);
        } else {
            $listSanPham = [];
        }

        require_once './views/main/home.php';
    }

    public function getSanPhamTheoDanhMuc()
    {
        $danhMucId = $_GET['id'] ?? null;
        if ($danhMucId) {
            $listSanPham = $this->modelSanPham->getSanPhamByDanhMucLM5($danhMucId);
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

    public function category()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        $danhMucId = $_GET['id'] ?? null;
        if ($danhMucId) {
            $listSanPham = $this->modelSanPham->getSanPhamByDanhMuc($danhMucId);
        } else {
            $listSanPham = [];
        }
        require_once './views/main/category.php';
    }

    public function sort()
    {
        $sortby = isset($_GET['by']) ? $_GET['by'] : 'default';

        $listSanPham = $this->modelSanPham->sortSanPham($_GET['id'], $sortby);

        if ($listSanPham) {
            echo json_encode($listSanPham);
        } else {
            echo json_encode([]);
        }
    }

    public function search()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();

        $keyword = $_GET['keyword'] ?? null;
        if ($keyword) {
            $listSanPham = $this->modelSanPham->searchSanPham($keyword);
        } else {
            $listSanPham = [];
        }

        require_once './views/main/search.php';
    }

    public function sortByKeyword()
    {
        $keyword = $_GET['keyword'] ?? null;
        $sortby = isset($_GET['by']) ? $_GET['by'] : 'default';

        // echo json_encode([$keyword, $sortby]);

        if ($keyword) {
            $listSanPham = $this->modelSanPham->sortSanPhamByKeyword($keyword, $sortby);
            echo json_encode($listSanPham);
        } else {
            echo json_encode([]);
        }
    }
}
