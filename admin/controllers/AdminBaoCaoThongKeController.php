<?php
class AdminBaoCaoThongKeController
{
    private $modelDonHang;
    private $modelTaiKhoan;
    private $modelSanPham;
    private $modelDanhMuc;


    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    public function home()
    {
        $listDonHang = $this->modelDonHang->getAllDonHang();
        $listTaiKhoan = $this->modelTaiKhoan->getAllTaiKhoan($chuc_vu_id = 2);
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        $listSanPham = $this->modelSanPham->getAllSanPham();

        require_once './views/home.php';
    }
}
