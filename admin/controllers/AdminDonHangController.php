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


    public function formEditDonHang()
    {
        $id = $_GET['id_don_hang'];
        $donHang = $this->modelDonHang->getDetailDonHang($id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        if ($donHang) {
            require_once './views/donhang/editDonHang.php';
            deleteSessionError();
        } else {
            header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
    }

    public function postEditDonHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];

            $don_hang_id = $_POST['don_hang_id'] ?? '';

            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';


            if (empty($ten_nguoi_nhan)) {
                $errors['ten_nguoi_nhan'] = 'Tên không được để trống';
            }

            if (empty($sdt_nguoi_nhan)) {
                $errors['sdt_nguoi_nhan'] = 'Sdt không được để trống';
            }

            if (empty($email_nguoi_nhan)) {
                $errors['email_nguoi_nhan'] = 'Email không được để trống';
            }

            if (empty($dia_chi_nguoi_nhan)) {
                $errors['dia_chi_nguoi_nhan'] = 'Địa chỉ không được để trống';
            }

            if (empty($trang_thai_id)) {
                $errors['trang_thai_id'] = 'Trạng thái đơn hàng';
            }


            $_SESSION['errors'] = $errors;
            // var_dump($errors);die;
            //Nếu ko có lỗi thì tiếng hành sửa

            if (empty($errors)) {
                //nếu ko có lỗi thì tiếng hành sửa
                //var_dump('ok')
                $abc = $this->modelDonHang->updateDonHang(
                    $don_hang_id,
                    $ten_nguoi_nhan,
                    $sdt_nguoi_nhan,
                    $email_nguoi_nhan,
                    $dia_chi_nguoi_nhan,
                    $ghi_chu,
                    $trang_thai_id,
                );
                // var_dump($abc);die;

                header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
                exit();
            } else {
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $don_hang_id);
                exit();
            }
        }
    }
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
