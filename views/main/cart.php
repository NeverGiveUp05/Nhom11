<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                            <!-- cho thanh 1 ham -->
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

                            <tbody id="table-body">
                                <!-- lam dong giong shop -->
                                <?php foreach ($arrSanPham as $item): ?>
                                    <tr>
                                        <td>
                                            <div class="cart-product">
                                                <div class="product-img">
                                                    <a href="#">
                                                        <img src="<?= $item['hinh_anh'] ?>" alt="">
                                                    </a>
                                                </div>

                                                <div class="product-info">
                                                    <a href="#">
                                                        <h3 class="product-name">
                                                            <?= $item['ten_san_pham'] ?>
                                                        </h3>
                                                    </a>
                                                    <div class="product-properties">
                                                        <p>Màu sắc: <span>Đỏ mận</span></p>
                                                        <p>Size: <span style="text-transform: uppercase">xxl</span></p>
                                                    </div>

                                                    <div class="product-properties">
                                                        <p>Giá gốc: <span><?= $item['gia_san_pham'] ?></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart-sale-price">

                                            <p class="cart-sale_item" style="text-align: center;">
                                                <?php if (isset($item['gia_khuyen_mai'])) {
                                                    echo $chietKhau = (($item['gia_san_pham'] - $item['gia_khuyen_mai']) / $item['gia_san_pham']) * 100;
                                                } ?>
                                            </p>
                                        </td>
                                        <td>
                                            <div data-id="${item.id}" class="product_quantity-input">
                                                <input onChange="typeValue(this, this.value)" type="number" value="<?= $item['so_luong'] ?>" min="0">
                                                <div onClick="increase(this)" class="product_quantity-increase">
                                                    +
                                                </div>
                                                <div onClick="reduce(this)" class="product_quantity-decrease">
                                                    -
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-price">
                                                <?php if (isset($item['gia_khuyen_mai'])) {
                                                    echo $item['gia_khuyen_mai'] * $item['so_luong'];
                                                } else {
                                                    echo $item['gia_san_pham'] * $item['so_luong'];
                                                } ?>
                                            </div>
                                        </td>
                                        <td>
                                            <button onClick="removePro(<?= $item['id'] ?>)" class="button-delete">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
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
                            <p class="total-product">
                                ${tongSanPham}
                            </p>
                        </div>
                        <div class="cart-summary-info">
                            <p>Tổng tiền hàng</p>
                            <p class="total-not-discount">
                                00000
                            </p>
                        </div>
                        <div class="cart-summary-info">
                            <p>Thành tiền</p>
                            <p>
                                <b class="order-price-total">
                                    00000
                                </b>
                            </p>
                        </div>
                        <div class="cart-summary-info">
                            <p>Tạm tính</p>
                            <p>
                                <b class="order-price-total">
                                    00000
                                </b>
                            </p>
                        </div>
                    </div>

                    <a href="<?php echo BASE_URL . '?act=checkout' ?>" class="cart-summary-button">Đặt hàng</a>
                </div>
            </div>
        </section>
    </main>

    <?php include './views/layout/footer.php' ?>

    <script>
        // Xử lý thêm sản phẩm vào giỏ hàng 
        function addProToCart(data) {
            fetch("<?= BASE_URL . '?act=add-to-cart' ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(data)
                })
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'error') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Bạn chưa đăng nhập',
                            text: res.message,
                            showCancelButton: true,
                            confirmButtonText: 'Đăng nhập',
                            cancelButtonText: 'Hủy'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '<?= BASE_URL ?>?act=login';
                            }
                        });
                    } else {
                        getDataCart(); // cập nhật giỏ hàng
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            text: res.message
                        });
                    }
                })
                .catch(err => console.error("Lỗi:", err));
        }

        const shopping = document.getElementById("shopping");
        const listNumberCart = document.getElementsByClassName("number-cart");
        const main = document.getElementById("main-shop");
        const total = document.getElementById("total");

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
                })
                .catch((err) => console.error("Lỗi:", err));
        };

        countPro();

        function openShop() {
            shopping.classList.add("open");
            getDataCart();
        };

        const closeShop = () => {
            shopping.classList.remove("open");
        };

        const makeShop = () => {
            main.innerHTML = "";

            if (arrPro.length == 0) {
                main.innerText = "Bạn chưa có sản phẩm nào";
            }

            countPro();

            // let totalPrice = 0;
            // arrPro.forEach(({
            //     item
            // }) => {
            //     totalPrice += item.gia_san_pham * item.so_luong;
            // });
            // total.innerText = totalPrice;

            let fetchPromises = arrPro.map((item) =>
                fetch("<?= BASE_URL ?>?act=get-product-by-id&id=" + item.san_pham_id)
                .then((res) => res.json())
                .then((data) => ({
                    data,
                    item
                }))
            );

            Promise.all(fetchPromises).then((results) => {
                results.forEach(({
                    data,
                    item
                }) => {
                    main.innerHTML += `
                <div class="item-product">
                    <div class="thumb"><img src="${data.hinh_anh}" alt="" /></div>
                    <div class="container-flex">
                        <div class="info-product">
                            <h3 id="product-name">${data.ten_san_pham}</h3>
                        </div>
                        <div class="trash" onClick="removePro(${data.id})">
                            <i class="fa-solid fa-trash-can"></i>
                        </div>
                        <div class="item-bottom">
                            <div class="quantity">
                                <div class="quantity-left" onClick="reduce(${item.gio_hang_id}, ${item.san_pham_id}, ${item.so_luong})">
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                                <input type="number" value="${item.so_luong}" 
                                    id="quantity-number" 
                                    onChange="typeValue(this, this.value)"/>
                                <div class="quantity-right" onClick="increase(${item.gio_hang_id}, ${item.san_pham_id}, ${item.so_luong})">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                            </div>
                            <div class="item-price">${data.gia_san_pham * item.so_luong}</div>
                        </div>
                    </div>
                </div>
            `;
                });
            }).catch((err) => console.error("Lỗi:", err));
        };

        function getDataCart() {
            fetch("<?= BASE_URL . '?act=get-cart' ?>")
                .then((res) => res.json())
                .then((data) => {
                    arrPro = data;
                    makeShop();
                })
                .catch((err) => console.error("Lỗi:", err));
        }

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
    </script>
</body>

</html>