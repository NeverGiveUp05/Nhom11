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
            $sql = "SELECT * FROM san_phams WHERE danh_muc_id = :danh_muc_id AND trang_thai = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':danh_muc_id' => $danhMucId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getSanPhamById($sanPhamId)
    {
        try {
            $sql = "SELECT sp.*, ha.link_hinh_anh 
            FROM san_phams sp 
            LEFT JOIN hinh_anh_san_phams ha ON sp.id = ha.san_pham_id 
            WHERE sp.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $sanPhamId]);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $sanPham = null;
            $linkHinhAnh = [];

            foreach ($data as $row) {
                if (!$sanPham) {
                    $sanPham = $row;
                }
                if ($row['link_hinh_anh']) {
                    $linkHinhAnh[] = $row['link_hinh_anh'];
                }
            }

            $sanPham['link_hinh_anh'] = $linkHinhAnh;
            return $sanPham;
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
