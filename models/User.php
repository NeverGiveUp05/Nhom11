<?php
class User
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function login($tai_khoan, $mat_khau)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :tai_khoan OR so_dien_thoai = :tai_khoan";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan' => $tai_khoan]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($mat_khau, $user['mat_khau'])) {
                return $user;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getRole($chuc_vu_id)
    {
        try {
            $sql = "SELECT ten_chuc_vu FROM chuc_vus WHERE id = :chuc_vu_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':chuc_vu_id' => $chuc_vu_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC)['ten_chuc_vu'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function checkAccount($email, $so_dien_thoai)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email OR so_dien_thoai = :so_dien_thoai";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email, ':so_dien_thoai' => $so_dien_thoai]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function register($hoTen, $anhDaiDien, $ngaySinh, $email, $soDienThoai, $gioiTinh, $diaChi, $matKhau)
    {
        try {
            $sql = "INSERT INTO tai_khoans (ho_ten, anh_dai_dien, ngay_sinh, email, so_dien_thoai, gioi_tinh, dia_chi, mat_khau) 
                VALUES (:ho_ten, :anh_dai_dien, :ngay_sinh, :email, :so_dien_thoai, :gioi_tinh, :dia_chi, :mat_khau)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten' => $hoTen,
                ':anh_dai_dien' => $anhDaiDien,
                ':ngay_sinh' => $ngaySinh,
                ':email' => $email,
                ':so_dien_thoai' => $soDienThoai,
                ':gioi_tinh' => $gioiTinh,
                ':dia_chi' => $diaChi,
                ':mat_khau' => password_hash($matKhau, PASSWORD_DEFAULT)
            ]);

            $lastId = $this->conn->lastInsertId();

            $sql = "SELECT * FROM tai_khoans WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $lastId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            return $user;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
}
