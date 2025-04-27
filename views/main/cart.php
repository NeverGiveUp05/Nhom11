<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StylMart</title>
    <link rel="shortcut icon" href="./public/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="./public/css/cart.css">
    <script src="https://kit.fontawesome.com/18ea624bf8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include './views/layout/header.php' ?>

    <main id="main">
        <section class="container">
            <div class="cart-page">
                <div class="col-lg-8 left-info">
                    <div class="checkout-process-bar">
                        <ul>
                            <li class="active"><span>Giỏ hàng </span></li>
                            <li class=""><span>Đặt hàng</span></li>
                            <li class=""><span>Thanh toán</span></li>
                            <li><span>Hoàn thành đơn</span></li>
                        </ul>
                    </div>

                    <div class="cart-list">
                        <h2 class="cart-title">Giỏ hàng của bạn <b><span id="cart-total" class="cart-total">

                                    <?php
                                    $tongSoLuong = 0;
                                    foreach ($arrSanPham as $item) {
                                        $tongSoLuong += $item['so_luong'];
                                    }
                                    echo $tongSoLuong;
                                    ?>
                                </span> Sản Phẩm</b></h2>

                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Sản phẩm</th>
                                    <th style="text-align: center;">Chiết khấu</th>
                                    <th style="text-align: center;">Số lượng</th>
                                    <th style="text-align: center;">Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody id="table-body"></tbody>
                        </table>
                    </div>

                    <a href="javascript: window.history.back();" class="btn-cart-continue">
                        <i style="margin-right: 8px" class="fa-solid fa-arrow-left"></i>
                        Tiếp tục mua hàng
                    </a>
                </div>

                <div class="col-lg-4 right-info">
                    <div id="bill" class="cart-summary">
                        <h3>Tổng tiền giỏ hàng</h3>
                        <div class="cart-summary-info">
                            <p>Tổng sản phẩm</p>
                            <p class="total-product" id="TongSanPham">
                                <?php
                                $tongSoLuong = 0;
                                foreach ($arrSanPham as $item) {
                                    $tongSoLuong += $item['so_luong'];
                                }
                                echo $tongSoLuong;
                                ?>
                            </p>
                        </div>
                        <div class="cart-summary-info">
                            <p>Tổng tiền hàng</p>
                            <p class="total-not-discount" id="TongTienHang">
                                <?php
                                $tongTienHang = 0;
                                foreach ($arrSanPham as $item): ?>
                                    <?php if (isset($item['gia_khuyen_mai'])) {
                                        $tongTienHang += $item['gia_khuyen_mai'] * $item['so_luong'];
                                    } else {
                                        $tongTienHang += $item['gia_san_pham'] * $item['so_luong'];
                                    }
                                    ?>
                                <?php endforeach;
                                echo $tongTienHang;
                                ?>
                            </p>
                        </div>
                        <div class="cart-summary-info">
                            <p>Phí ship</p>
                            <p class="total-not-discount">
                                200000
                            </p>
                        </div>
                        <div class="cart-summary-info">
                            <p>Thành tiền</p>
                            <p>
                                <b class="order-price-total" id="ThanhTien">
                                    <?= $tongTienHang + 200000 ?>
                                </b>
                            </p>
                        </div>
                    </div>

                    <div id="DatHang">
                        <?php if (empty($arrSanPham)): ?>
                            <button onclick="alertError()" class="cart-summary-button">Đặt hàng</button>
                        <?php else: ?>
                            <a href="<?php echo BASE_URL . '?act=checkout' ?>" class="cart-summary-button">Đặt hàng</a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <?php include './views/layout/footer.php' ?>

    <script>
        const listNumberCart = document.getElementsByClassName("number-cart");
        const main = document.getElementById("table-body");
        const cartTotal = document.getElementById("cart-total");
        const TongSanPham = document.getElementById("TongSanPham");
        const TongTienHang = document.getElementById("TongTienHang");
        const ThanhTien = document.getElementById("ThanhTien");
        const DatHang = document.getElementById("DatHang");

        function alertError() {
            Swal.fire({
                icon: 'error',
                title: 'Giỏ hàng trống',
                text: 'Vui lòng thêm sản phẩm vào giỏ hàng trước khi đặt hàng!',
                confirmButtonText: 'OK'
            });
        }

        function countPro() {
            fetch("<?= BASE_URL . '?act=get-cart' ?>")
                .then((res) => res.json())
                .then((data) => {
                    let count = 0;
                    data.forEach((item) => {
                        count += item.so_luong;
                    });
                    listNumberCart[0].innerText = count;
                    listNumberCart[1].innerText = count;
                    cartTotal.innerText = count;
                    TongSanPham.innerText = count;
                })
                .catch((err) => console.error("Lỗi:", err));
        };

        const makeData = () => {
            main.innerHTML = "";

            if (arrPro.length == 0) {
                main.innerText = "Bạn chưa có sản phẩm nào";
            }

            countPro();

            let fetchPromises = arrPro.map((item) =>
                fetch("<?= BASE_URL ?>?act=get-product-by-id&id=" + item.san_pham_id)
                .then((res) => res.json())
                .then((data) => ({
                    data,
                    item
                }))
            );

            Promise.all(fetchPromises).then((results) => {
                let totalPrice = 0;

                results.forEach(({
                    data,
                    item
                }) => {
                    if (data.gia_khuyen_mai) {
                        totalPrice += data.gia_khuyen_mai * item.so_luong;
                        chietKhau = (((data.gia_san_pham - data.gia_khuyen_mai) / data.gia_san_pham) * 100).toFixed(2) + '%';
                        giaBan = data.gia_khuyen_mai;
                    } else {
                        totalPrice += data.gia_san_pham * item.so_luong;
                        chietKhau = '0 %';
                        giaBan = data.gia_san_pham;
                    }

                    totalItem = giaBan * item.so_luong;

                    main.innerHTML += `
                <tr>
                                        <td>
                                            <div class="cart-product">
                                                <div class="product-img">
                                                    <a href="#">
                                                        <img src="${data.hinh_anh}" alt="">
                                                    </a>
                                                </div>

                                                <div class="product-info">
                                                    <a href="#">
                                                        <h3 class="product-name">
                                                            ${data.ten_san_pham}
                                                        </h3>
                                                    </a>
                                                    <div class="product-properties">
                                                        <p>Màu sắc: <span>Đỏ mận</span></p>
                                                        <p>Size: <span style="text-transform: uppercase">xxl</span></p>
                                                    </div>

                                                    <div class="product-properties">
                                                        <p>Giá gốc: <span>${data.gia_san_pham}</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart-sale-price">

                                            <p class="cart-sale_item" style="text-align: center;">
                                                ${chietKhau}
                                            </p>
                                        </td>
                                        <td>
                                            <div data-id="${item.id}" class="product_quantity-input">
                                                <input onChange="typeValue(this, this.value)" type="number" value="${item.so_luong}" min="0">
                                                <div onClick="increase(${item.gio_hang_id}, ${item.san_pham_id}, ${item.so_luong})" class="product_quantity-increase">
                                                    +
                                                </div>
                                                <div onClick="reduce(${item.gio_hang_id}, ${item.san_pham_id}, ${item.so_luong})" class="product_quantity-decrease">
                                                    -
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-price">
                                                ${totalItem}
                                            </div>
                                        </td>
                                        <td>
                                            <button onClick="removePro(${data.id}, ${item.gio_hang_id})" class="button-delete">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </td>
                                    </tr>
            `;
                });

                TongTienHang.innerText = totalPrice;
                ThanhTien.innerText = totalPrice + 200000;

                if (results.length == 0) {
                    DatHang.innerHTML = '<button onclick="alertError()" class="cart-summary-button">Đặt hàng</button>';
                } else {
                    DatHang.innerHTML = '<a href="<?= BASE_URL ?>?act=checkout" class="cart-summary-button">Đặt hàng</a>';
                }
            }).catch((err) => console.error("Lỗi:", err));
        };

        function getDataCart() {
            fetch("<?= BASE_URL . '?act=get-cart' ?>")
                .then((res) => res.json())
                .then((data) => {
                    arrPro = data;
                    makeData();
                })
                .catch((err) => console.error("Lỗi:", err));
        }

        getDataCart();

        countPro();

        function openShop() {};

        const closeShop = () => {};

        function reduce(cartId, proId, soLuong) {
            if (soLuong > 1) {
                fetch("<?= BASE_URL ?>?act=reduce-quantity", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            id: proId,
                            cartId: cartId,
                            soLuongGiam: 1
                        })
                    })
                    .then((res) => res.json())
                    .then((data) => {
                        console.log(data);
                        getDataCart();
                    })
                    .catch((err) => console.error("Lỗi:", err));
            }
        }

        function increase(cartId, proId, soLuong) {
            if (soLuong < 99) {
                fetch("<?= BASE_URL ?>?act=increase-quantity", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            id: proId,
                            cartId: cartId,
                            soLuongTang: 1
                        })
                    })
                    .then((res) => res.json())
                    .then((data) => {
                        console.log(data);
                        getDataCart();
                    })
                    .catch((err) => console.error("Lỗi:", err));
            }
        }

        function removePro(id, cartId) {
            fetch("<?= BASE_URL ?>?act=remove-product", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id: id,
                        cartId: cartId
                    })
                })
                .then((res) => res.json())
                .then((data) => {
                    getDataCart();
                })
                .catch((err) => console.error("Lỗi:", err));
        }
    </script>
</body>

</html>