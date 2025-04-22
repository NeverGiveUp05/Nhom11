<?php
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminDonHangController.php';
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaiKhoanController.php';




// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminDonHang.php';
require_once './models/AdminTaiKhoan.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
match ($act) {
    //route báo cáo thống kê
    '/' => routeAdmin(fn() => new AdminBaoCaoThongKeController())->home(),

    //Route danh mục sản phẩm
    'danh-muc' => routeAdmin(fn() => new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc' => routeAdmin(fn() => new AdminDanhMucController())->formAddDanhMuc(),
    'them-danh-muc' => routeAdmin(fn() => new AdminDanhMucController())->postAddDanhMuc(),
    'form-sua-danh-muc' => routeAdmin(fn() => new AdminDanhMucController())->formEditDanhMuc(),
    'sua-danh-muc' => routeAdmin(fn() => new AdminDanhMucController())->postEditDanhMuc(),
    'xoa-danh-muc' => routeAdmin(fn() => new AdminDanhMucController())->deleteDanhMuc(),

    //Route sản phẩm
    'san-pham' => routeAdmin(fn() => new AdminSanPhamController())->danhSachSanPham(),
    'form-them-san-pham' => routeAdmin(fn() => new AdminSanPhamController())->formAddSanPham(),
    'them-san-pham' => routeAdmin(fn() => new AdminSanPhamController())->postAddSanPham(),
    'form-sua-san-pham' => routeAdmin(fn() => new AdminSanPhamController())->formEditSanPham(),
    'sua-san-pham' => routeAdmin(fn() => new AdminSanPhamController())->postEditSanPham(),
    // 'sua-album-anh-san-pham' => (new AdminSanPhamController())->postEditAnhSanPham(),
    // 'xoa-san-pham' => (new AdminSanPhamController())->deleteSanPham(),

    //Route quản lí đơn hàng
    'don-hang' => routeAdmin(fn() => new AdminDonHangController())->danhSachDonHang(),
    'form-sua-don-hang' => routeAdmin(fn() => new AdminDonHangController())->formEditDonHang(),
    'sua-don-hang' => routeAdmin(fn() => new AdminDonHangController())->postEditDonHang(),
    // 'xoa-don-hang' => (new AdminDonHangController())->deleteDonHang(),
    'chi-tiet-don-hang' => routeAdmin(fn() => new AdminDonHangController())->detailDonHang(),

    //route quản lý tài khoản
    //quản lý tk quản trị
    'list-tai-khoan-quan-tri' => routeAdmin(fn() => new AdminTaiKhoanController())->danhSachQuanTri(),
    'form-them-quan-tri' => routeAdmin(fn() => new AdminTaiKhoanController())->formAddQuanTri(),
    'post-quan-tri' => routeAdmin(fn() => new AdminTaiKhoanController())->postAddQuanTri(),
    'form-sua-quan-tri' => routeAdmin(fn() => new AdminTaiKhoanController())->formEditQuanTri(),
    'sua-quan-tri' => routeAdmin(fn() => new AdminTaiKhoanController())->postEditQuanTri(),

    //Route reser password tài khoản
    'reset-password' => routeAdmin(fn() => new AdminTaiKhoanController())->resetPassword(),

    // Quản lý tài khoản khách hàng
    'list-tai-khoan-khach-hang' => routeAdmin(fn() => new AdminTaiKhoanController())->danhSachKhachHang(),
    'form-sua-khach-hang' => routeAdmin(fn() => new AdminTaiKhoanController())->formEditKhachHang(),
    'sua-khach-hang' => routeAdmin(fn() => new AdminTaiKhoanController())->postEditKhachHang(),
    'chi-tiet-khach-hang' => (new AdminTaiKhoanController())->detailKhachHang(),

};
