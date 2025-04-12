<?php
class CartController
{
    private $modelCart;
    private $modelSanPham;

    public function __construct()
    {
        $this->modelCart = new Cart();
        $this->modelSanPham = new SanPham();
    }

    public function addToCart()
    {
        header('Content-Type: application/json');

        $raw = file_get_contents("php://input");
        $data = json_decode($raw, true);

        $userId = $_SESSION['user']['id'] ?? '';
        $sanPhamId = $data['id'];
        $soLuong = $data['soluong'];

        if (!$userId) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Vui lòng đăng nhập để thực hiện chức năng này'
            ]);
            exit;
        }

        // Kiểm tra giỏ hàng của user đã tồn tại chưa
        $cartIdExist = $this->modelCart->checkCartExist($userId);

        if (!$cartIdExist) {
            $cartId = $this->modelCart->createCart($userId);
            $this->modelCart->addProToCart($cartId, $sanPhamId, $soLuong);
        } else {
            // Nếu giỏ hàng đã tồn tại thì kiểm tra sản phẩm đã có trong giỏ hàng chưa
            $soLuongCu = $this->modelCart->checkProExistInCart($cartIdExist['id'], $sanPhamId);

            if ($soLuongCu) {
                // Nếu sản phẩm đã có trong giỏ hàng thì cập nhật số lượng
                $soLuong = $soLuongCu['so_luong'] + $soLuong;
                $this->modelCart->updateProInCart($cartIdExist['id'], $sanPhamId, $soLuong);
            } else {
                // Nếu sản phẩm chưa có trong giỏ hàng thì thêm mới
                $soLuong = $soLuong;
                $this->modelCart->addProToCart($cartIdExist['id'], $sanPhamId, $soLuong);
            }
        }

        echo json_encode([
            'message' => 'Đã thêm sản phẩm vào giỏ hàng',
        ]);

        exit;
    }

    public function getCart()
    {
        header('Content-Type: application/json');

        $userId = $_SESSION['user']['id'] ?? '';

        if (!$userId) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Vui lòng đăng nhập'
            ]);
            exit;
        }

        // Kiểm tra giỏ hàng của user đã tồn tại chưa
        $cartIdExist = $this->modelCart->checkCartExist($userId);

        if ($cartIdExist) {
            $cartDetails = $this->modelCart->getCartDetails($cartIdExist['id']);
            echo json_encode($cartDetails);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Giỏ hàng trống'
            ]);
        }

        exit;
    }

    public function getProductById()
    {
        header('Content-Type: application/json');

        $sanPhamId = $_GET['id'] ?? null;

        if (!$sanPhamId) {
            echo json_encode(['status' => 'error', 'message' => 'Sản phẩm không tồn tại']);
            exit;
        }

        $product = $this->modelSanPham->getSanPhamById($sanPhamId);
        echo json_encode($product);
        exit;
    }

    public function reduceQuantity()
    {
        header('Content-Type: application/json');

        $raw = file_get_contents("php://input");
        $data = json_decode($raw, true);

        $sanPhamId = $data['id'];
        $cartId = $data['cartId'];
        $soLuongGiam = $data['soLuongGiam'];

        if (!$sanPhamId) {
            echo json_encode(['status' => 'error', 'message' => 'Sản phẩm không tồn tại']);
            exit;
        }

        $this->modelCart->reduceQuantityProduct($cartId, $sanPhamId, $soLuongGiam);
        echo json_encode(['message' => 'Cập nhật thành công']);
        exit;
    }

    public function increaseQuantity()
    {
        header('Content-Type: application/json');

        $raw = file_get_contents("php://input");
        $data = json_decode($raw, true);

        $sanPhamId = $data['id'];
        $cartId = $data['cartId'];
        $soLuongTang = $data['soLuongTang'];

        if (!$sanPhamId) {
            echo json_encode(['status' => 'error', 'message' => 'Sản phẩm không tồn tại']);
            exit;
        }

        $this->modelCart->increaseQuantityProduct($cartId, $sanPhamId, $soLuongTang);
        echo json_encode(['message' => 'Cập nhật thành công']);
        exit;
    }

    public function getCartPage()
    {
        $userId = $_SESSION['user']['id'] ?? '';

        if (!$userId) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Hãy đăng nhập để xem giỏ hàng'
            ]);
            exit;
        }

        // Kiểm tra giỏ hàng của user đã tồn tại chưa
        $cartIdExist = $this->modelCart->checkCartExist($userId);

        $cartDetails = $this->modelCart->getCartDetails($cartIdExist['id']);
        $arrSanPham = [];
        foreach ($cartDetails as $item) {
            $data = $this->modelSanPham->getSanPhamById($item['san_pham_id']);
            // data['so_luong] là số lượng sản phẩm trong kho nên cần cập nhật số lượng sản phẩm trong giỏ hàng
            $data['so_luong'] = $item['so_luong'];
            $arrSanPham[] = $data;
        }
        require_once './views/main/cart.php';
    }

    public function checkout()
    {
        $userId = $_SESSION['user']['id'] ?? '';

        if (!$userId) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Hãy đăng nhập để thực hiện chức năng này'
            ]);
            exit;
        }

        // Kiểm tra giỏ hàng của user đã tồn tại chưa
        $cartIdExist = $this->modelCart->checkCartExist($userId);

        $cartDetails = $this->modelCart->getCartDetails($cartIdExist['id']);
        $arrSanPham = [];
        foreach ($cartDetails as $item) {
            $data = $this->modelSanPham->getSanPhamById($item['san_pham_id']);
            // data['so_luong'] là số lượng sản phẩm trong kho nên cần cập nhật số lượng sản phẩm trong giỏ hàng
            $data['so_luong'] = $item['so_luong'];
            $arrSanPham[] = $data;
        }

        $phuongThucThanhToans = $this->modelCart->getPhuongThucThanhToan();
        require_once './views/main/checkout.php';
    }

    public function handleCheckout()
    {
        $userId = $_SESSION['user']['id'] ?? '';

        if (!$userId) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Hãy đăng nhập để thực hiện chức năng này'
            ]);
            exit;
        }

        $maDonHang = generateOrderCode();
        $tenNguoiNhan = $_POST['ten_nguoi_nhan'] ?? null;
        $sdtNguoiNhan = $_POST['sdt_nguoi_nhan'] ?? null;
        $emailNguoiNhan = $_POST['email_nguoi_nhan'] ?? null;
        $diaChiNguoiNhan = $_POST['dia_chi_nguoi_nhan'] ?? null;
        $ngayDat = date('Y-m-d');
        $phuongThucThanhToanId = $_POST['phuong_thuc_thanh_toan_id'] ?? null;
        $ghiChu = $_POST['ghi_chu'] ?? null;
        $trangThaiId = 1;

        // lấy id cart
        $cartIdExist = $this->modelCart->checkCartExist($userId);

        if ($cartIdExist) {
            $cartDetails = $this->modelCart->getCartDetails($cartIdExist['id']);
            $tongTien = 0;
            foreach ($cartDetails as $item) {
                $data = $this->modelSanPham->getSanPhamById($item['san_pham_id']);

                // kiểm tra số lượng sản phẩm trong kho có đủ không
                if ($data['so_luong'] < $item['so_luong']) {
                    echo 'Sản phẩm ' . $data['ten_san_pham'] . ' không đủ số lượng trong kho';
                    exit;
                }

                // data['so_luong'] là số lượng sản phẩm trong kho nên cần cập nhật số lượng sản phẩm trong giỏ hàng
                $data['so_luong'] = $item['so_luong'];

                if ($data['gia_khuyen_mai']) {
                    $tongTien += $data['gia_khuyen_mai'] * $item['so_luong'];
                } else {
                    $tongTien += $data['gia_san_pham'] * $item['so_luong'];
                }
            }

            // thêm đơn hàng vào db
            $donHangId = $this->modelCart->datHang($maDonHang, $userId, $tenNguoiNhan, $emailNguoiNhan, $sdtNguoiNhan, $diaChiNguoiNhan, $ngayDat, $tongTien, $ghiChu, $phuongThucThanhToanId, $trangThaiId);

            // thêm chi tiết đơn hàng vào db
            foreach ($cartDetails as $item) {
                $data = $this->modelSanPham->getSanPhamById($item['san_pham_id']);

                if ($data['gia_khuyen_mai']) {
                    $donGia = $data['gia_khuyen_mai'];
                    $thanhTien = $data['gia_khuyen_mai'] * $item['so_luong'];
                } else {
                    $donGia = $data['gia_san_pham'];
                    $thanhTien = $data['gia_san_pham'] * $item['so_luong'];
                }
                $this->modelCart->addChiTietDonHang($donHangId, $item['san_pham_id'], $donGia, $item['so_luong'], $thanhTien);

                // cập nhật số lượng sản phẩm trong kho
                $this->modelSanPham->updateSoLuongSanPham($item['san_pham_id'], $data['so_luong'] - $item['so_luong']);
            }

            // xóa giỏ hàng sau khi đặt hàng thành công
            $this->modelCart->clearCart($cartIdExist['id']);
        }

        header('Location: ./?act=order-view');
    }

    public function getViewOrder()
    {
        $userId = $_SESSION['user']['id'] ?? '';

        if (!$userId) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Hãy đăng nhập để thực hiện chức năng này'
            ]);
            exit;
        }

        $donHang = $this->modelCart->getDonHangByUserId($userId);

        require_once './views/main/order.php';
    }

    public function handleHuyDon()
    {
        header('Content-Type: application/json');

        $raw = file_get_contents("php://input");
        $data = json_decode($raw, true);

        $userId = $_SESSION['user']['id'] ?? '';

        if (!$userId) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Hãy đăng nhập để thực hiện chức năng này'
            ]);
            exit;
        }

        $donHangId = $data['id'] ?? null;
        if (!$donHangId) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Đơn hàng không tồn tại'
            ]);
            exit;
        }

        if ($this->modelCart->huyDonHang($donHangId)) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Hủy đơn hàng thành công'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Hủy đơn hàng thất bại'
            ]);
        }
        exit;
    }
}
