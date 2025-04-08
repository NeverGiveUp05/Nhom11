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
            $sql = "SELECT * FROM tai_khoans WHERE( email = :tai_khoan OR so_dien_thoai = :tai_khoan ) AND mat_khau = :mat_khau";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan' => $tai_khoan, ':mat_khau' => $mat_khau]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
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
}
