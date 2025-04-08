<?php
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/CartController.php';
require_once './controllers/UserController.php';

// Require toàn bộ file Models
require_once './models/DanhMuc.php';
require_once './models/SanPham.php';
require_once './models/Cart.php';
require_once './models/User.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    '/' => (new HomeController())->home(),

    'add-to-cart' => (new CartController())->addToCart(),
    'get-cart' => (new CartController())->getCart(),
    'get-product-by-id' => (new CartController())->getProductById(),
    'reduce-quantity' => (new CartController())->reduceQuantity(),
    'increase-quantity' => (new CartController())->increaseQuantity(),

    'cart' => (new CartController())->getCartPage(),

    'login' => (new UserController())->login(),
    'user-login' => (new UserController())->handleLogin(),
    'logout' => (new UserController())->logout(),

    'checkout' => (new CartController())->checkout(),
    'handle-checkout' => (new CartController())->handleCheckout(),
    'order-view' => (new CartController())->getViewOrder(),
    'handle-huydon' => (new CartController())->handleHuyDon(),

    // 'danh-sach-san-pham' => (new HomeController())->danhSachSanPham(),
};
