<?php
class Cart
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function checkCartExist($userId)
    {
        try {
            $sql = "SELECT id FROM gio_hangs WHERE tai_khoan_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function createCart($userId)
    {
        try {
            $sql = "INSERT INTO gio_hangs (tai_khoan_id) VALUES (:user_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':user_id' => $userId]);
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function checkProExistInCart($cartId, $productId)
    {
        try {
            $sql = "SELECT so_luong FROM chi_tiet_gio_hangs WHERE gio_hang_id = :cart_id AND san_pham_id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':cart_id' => $cartId,
                ':product_id' => $productId
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addProToCart($cartId, $sanPhamId, $soLuong)
    {
        try {
            $sql = "INSERT INTO chi_tiet_gio_hangs (gio_hang_id, san_pham_id, so_luong) VALUES (:cart_id, :san_pham_id, :so_luong)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':cart_id' => $cartId,
                ':san_pham_id' => $sanPhamId,
                ':so_luong' => $soLuong
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateProInCart($cartId, $productId, $soLuong)
    {
        try {
            $sql = "UPDATE chi_tiet_gio_hangs SET so_luong = :so_luong WHERE gio_hang_id = :cart_id AND san_pham_id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':so_luong' => $soLuong,
                ':cart_id' => $cartId,
                ':product_id' => $productId
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getCartDetails($cartId)
    {
        try {
            $sql = "SELECT * FROM chi_tiet_gio_hangs WHERE gio_hang_id = :cart_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':cart_id' => $cartId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function reduceQuantityProduct($cartId, $productId, $soLuongGiam)
    {
        try {
            $sql = "UPDATE chi_tiet_gio_hangs SET so_luong = so_luong - :quantity WHERE gio_hang_id = :cart_id AND san_pham_id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':quantity' => $soLuongGiam,
                ':cart_id' => $cartId,
                ':product_id' => $productId
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function increaseQuantityProduct($cartId, $productId, $soLuongTang)
    {
        try {
            $sql = "UPDATE chi_tiet_gio_hangs SET so_luong = so_luong + :quantity WHERE gio_hang_id = :cart_id AND san_pham_id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':quantity' => $soLuongTang,
                ':cart_id' => $cartId,
                ':product_id' => $productId
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function removeFromCart($cartId, $sanPhamId)
    {
        try {
            $sql = "DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id = :cart_id AND san_pham_id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':cart_id' => $cartId,
                ':product_id' => $sanPhamId
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function clearCart($cartId)
    {
        try {
            $sql = "DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id = :cart_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':cart_id' => $cartId]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getPhuongThucThanhToan()
    {
        try {
            $sql = "SELECT * FROM phuong_thuc_thanh_toans";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function datHang($maDonHang, $userId, $tenNguoiNhan, $emailNguoiNhan, $sdtNguoiNhan, $diaChiNguoiNhan, $ngayDat, $tongTien, $ghiChu, $phuongThucThanhToanId, $trangThaiId)
    {
        try {
            $sql = "INSERT INTO don_hangs (ma_don_hang, tai_khoan_id, ten_nguoi_nhan, email_nguoi_nhan, sdt_nguoi_nhan, dia_chi_nguoi_nhan, ngay_dat, tong_tien, ghi_chu, phuong_thuc_thanh_toan_id, trang_thai_id) VALUES (:ma_don_hang, :user_id, :ten_nguoi_nhan, :email_nguoi_nhan, :sdt_nguoi_nhan, :dia_chi_nguoi_nhan, :ngay_dat, :tong_tien, :ghi_chu, :phuong_thuc_thanh_toan_id, :trang_thai_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ma_don_hang' => $maDonHang,
                ':user_id' => $userId,
                ':ten_nguoi_nhan' => $tenNguoiNhan,
                ':email_nguoi_nhan' => $emailNguoiNhan,
                ':sdt_nguoi_nhan' => $sdtNguoiNhan,
                ':dia_chi_nguoi_nhan' => $diaChiNguoiNhan,
                ':ngay_dat' => $ngayDat,
                ':tong_tien' => $tongTien,
                ':ghi_chu' => $ghiChu,
                ':phuong_thuc_thanh_toan_id' => $phuongThucThanhToanId,
                ':trang_thai_id' => $trangThaiId
            ]);
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addChiTietDonHang($donHangId, $sanPhamId, $donGia, $soLuong, $thanhTien)
    {
        try {
            $sql = "INSERT INTO chi_tiet_don_hangs (don_hang_id, san_pham_id, don_gia, so_luong, thanh_tien) VALUES (:don_hang_id, :san_pham_id, :don_gia, :so_luong, :thanh_tien)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':don_hang_id' => $donHangId,
                ':san_pham_id' => $sanPhamId,
                ':don_gia' => $donGia,
                ':so_luong' => $soLuong,
                ':thanh_tien' => $thanhTien
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getDonHangByUserId($id)
    {
        try {
            $sql = "
                SELECT dh.*, tt.ten_trang_thai
                FROM don_hangs dh
                JOIN trang_thai_don_hangs tt ON dh.trang_thai_id = tt.id
                WHERE dh.tai_khoan_id = :user_id
                ORDER BY dh.id DESC
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':user_id' => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function huyDonHang($donHangId)
    {
        try {
            // 1. Cập nhật trạng thái đơn hàng
            $sqlUpdate = "UPDATE don_hangs SET trang_thai_id = 11 WHERE id = :don_hang_id";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            $stmtUpdate->execute([':don_hang_id' => $donHangId]);

            // 2. Lấy lại thông tin đơn hàng sau khi cập nhật
            $sqlSelect = "SELECT * FROM don_hangs WHERE id = :don_hang_id";
            $stmtSelect = $this->conn->prepare($sqlSelect);
            $stmtSelect->execute([':don_hang_id' => $donHangId]);

            // 3. Trả về dữ liệu đơn hàng (kiểu mảng kết hợp)
            $donHang = $stmtSelect->fetch(PDO::FETCH_ASSOC);
            return $donHang;
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getDonHangChiTietById($donHangId)
    {
        try {
            $sql = "
                SELECT don_hangs.*, chi_tiet_don_hangs.*, san_phams.*, trang_thai_don_hangs.ten_trang_thai, phuong_thuc_thanh_toans.ten_phuong_thuc
                FROM don_hangs
                JOIN chi_tiet_don_hangs ON don_hangs.id = chi_tiet_don_hangs.don_hang_id
                JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
                JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
                JOIN phuong_thuc_thanh_toans ON don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toans.id
                WHERE don_hangs.id = :don_hang_id
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':don_hang_id' => $donHangId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
