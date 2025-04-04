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

    public function removeFromCart($productId)
    {
        // Logic to remove product from cart
    }

    public function clearCart()
    {
        // Logic to clear the cart
    }
}
