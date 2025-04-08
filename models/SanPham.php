<?php
class SanPham
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllSanPham()
    {
        try {
            $sql = "SELECT * FROM san_phams";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getSanPhamByDanhMuc($danhMucId)
    {
        try {
            $sql = "SELECT * FROM san_phams WHERE danh_muc_id = :danh_muc_id LIMIT 5";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':danh_muc_id' => 2]); // test mac dinh la 2 sau sua thanh $danhMucId
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getSanPhamById($sanPhamId)
    {
        try {
            $sql = "SELECT * FROM san_phams WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $sanPhamId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateSoLuongSanPham($sanPhamId, $soLuong)
    {
        try {
            $sql = "UPDATE san_phams SET so_luong = :so_luong WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':so_luong' => $soLuong, ':id' => $sanPhamId]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
