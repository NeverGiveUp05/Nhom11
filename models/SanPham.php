<?php
class SanPham {
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllProduct() {
        try {
            $sql = "SELECT * FROM san_phams";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}