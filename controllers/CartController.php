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

        $userId = $_SESSION['user']['id'] ?? 1;
        $sanPhamId = $data['id'];
        $soLuong = $data['soluong'];

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

        // Trả về JSON
        echo json_encode([
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công'
        ]);

        exit;
    }

    public function getCart()
    {
        header('Content-Type: application/json');

        $userId = $_SESSION['user']['id'] ?? 1;

        // Kiểm tra giỏ hàng của user đã tồn tại chưa
        $cartIdExist = $this->modelCart->checkCartExist($userId);

        if ($cartIdExist) {
            $cartDetails = $this->modelCart->getCartDetails($cartIdExist['id']);
            echo json_encode($cartDetails);
        } else {
            echo json_encode([
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
            echo json_encode(['message' => 'Sản phẩm không tồn tại']);
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
            echo json_encode(['message' => 'Sản phẩm không tồn tại']);
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
            echo json_encode(['message' => 'Sản phẩm không tồn tại']);
            exit;
        }

        $this->modelCart->increaseQuantityProduct($cartId, $sanPhamId, $soLuongTang);
        echo json_encode(['message' => 'Cập nhật thành công']);
        exit;
    }
}
