<?php
class AdminDonHangController
{
    private $modelDonHang;


    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();

    }

    public function danhSachDonHang()
    {
        $listDonHang = $this->modelDonHang->getAllDonHang();
        require_once './views/donhang/listDonHang.php';
    }
    public function detailDonHang()
    {
        $don_hang_id = $_GET['id_don_hang'];
    
        //Lấy thông tin đơn hàng ở bảng don_hangs
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);
    
        // Lấy danh sách sản phẩm đã đặt của đơn hàng ở bảng chi_tiet_don_hangs
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);

        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
    
        require_once './views/donhang/detailDonHang.php';
    }
    



    // public function formEditSanPham()
    // {
    //     $id = $_GET['id_san_pham'];
    //     $sanPham = $this->modelSanPham->getDetailSanPham($id);
    //     $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
    //     $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
    //     if ($sanPham) {
    //         require_once './views/sanpham/editSanPham.php';
    //         deleteSessionError();
    //     } else {
    //         header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
    //         exit();
    //     }
    // }

    // public function postEditSanPham()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $san_pham_id = $_POST['id_san_pham'] ?? '';

    //         $sanPhamOld = $this->modelSanPham->getDetailSanPham($san_pham_id);
    //         $old_file = $sanPhamOld['hinh_anh'];

    //         $ten_san_pham = $_POST['ten_san_pham'] ?? '';
    //         $gia_san_pham = $_POST['gia_san_pham'] ?? '';
    //         $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
    //         $so_luong = $_POST['so_luong'] ?? '';
    //         $ngay_nhap = $_POST['ngay_nhap'] ?? '';
    //         $danh_muc_id = $_POST['danh_muc_id'] ?? '';
    //         $trang_thai = $_POST['trang_thai'] ?? '';
    //         $mo_ta = $_POST['mo_ta'] ?? '';

    //         $hinh_anh = $_FILES['hinh_anh'] ?? null;

    //         if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
    //             $new_file = uploadFile($hinh_anh, './uploads/');
    //             if (!empty($old_file)) {
    //                 deleteFile($old_file);
    //             }
    //         } else {
    //             $new_file = $old_file;
    //         }

    //         $errors = [];

    //         if (empty($ten_san_pham)) {
    //             $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
    //         }

    //         if (empty($gia_san_pham)) {
    //             $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống';
    //         }

    //         if (empty($gia_khuyen_mai)) {
    //             $errors['gia_khuyen_mai'] = 'Giá khuyến mãi sản phẩm không được để trống';
    //         }

    //         if (empty($so_luong)) {
    //             $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
    //         }

    //         if (empty($ngay_nhap)) {
    //             $errors['ngay_nhap'] = 'Ngày nhập phẩm không được để trống';
    //         }

    //         if (empty($so_luong)) {
    //             $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
    //         }

    //         if (empty($danh_muc_id)) {
    //             $errors['danh_muc_id'] = 'Danh mục sản phẩm phải chọn';
    //         }

    //         if (empty($trang_thai)) {
    //             $errors['trang_thai'] = 'Trạng thái phẩm phải chọn';
    //         }

    //         $_SESSION['errors'] = $errors;

    //         if (empty($errors)) {
    //             $this->modelSanPham->updateSanPham(
    //                 $san_pham_id,
    //                 $ten_san_pham,
    //                 $gia_san_pham,
    //                 $gia_khuyen_mai,
    //                 $so_luong,
    //                 $ngay_nhap,
    //                 $danh_muc_id,
    //                 $trang_thai,
    //                 $mo_ta,
    //                 $new_file
    //             );

    //             header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
    //             exit();
    //         } else {
    //             $_SESSION['flash'] = true;
    //             header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
    //             exit();
    //         }
    //     }
    // }
}


    //     public function deleteDanhMuc()
    //     {
    //         $id = $_GET['id_danh_muc'];
    //         $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);

    //         if ($danhMuc) {
    //             $this->modelDanhMuc->destroyDanhMuc($id);
    //         }

    //         header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
    //     }
// }
