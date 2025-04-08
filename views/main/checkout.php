<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <!-- Pe-icon-7-stroke CSS -->
    <link rel="stylesheet" href="assets/css/vendor/pe-icon-7-stroke.css">
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <!-- Slick slider css -->
    <link rel="stylesheet" href="assets/css/plugins/slick.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css">
    <!-- Nice Select css -->
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <!-- jquery UI css -->
    <link rel="stylesheet" href="assets/css/plugins/jqueryui.min.css">
    <!-- main style css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="./public/css/cart.css">
    <script src="https://kit.fontawesome.com/18ea624bf8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include './views/layout/header.php' ?>

    <main id="main">
        <section class="container">
            <form class="row mt-4 mb-4" action="<?= BASE_URL ?>?act=handle-checkout" method="POST">
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h5 class="checkout-title">Thông tin người nhận</h5>
                        <div class="billing-form-wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-input-item" style="margin-top: 0">
                                        <label class="required">Họ tên</label>
                                        <input type="text" name="ten_nguoi_nhan" placeholder="Họ tên" required="" fdprocessedid="g4h4wc">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input-item" style="margin-top: 0">
                                        <label class="required">Số điện thoại</label>
                                        <input type="number" name="sdt_nguoi_nhan" placeholder="Số điện thoại" required="" fdprocessedid="q3mgta">
                                    </div>
                                </div>
                            </div>

                            <div class="single-input-item">
                                <label class="required">Email</label>
                                <input type="email" name="email_nguoi_nhan" placeholder="Email" required="" fdprocessedid="u0vwm">
                            </div>

                            <div class="single-input-item">
                                <label class="required">Địa chỉ nhận hàng</label>
                                <input type="text" name="dia_chi_nguoi_nhan" placeholder="Địa chỉ nhận hàng" required="" fdprocessedid="u0vwm">
                            </div>

                            <div class="single-input-item">
                                <label>Ghi chú</label>
                                <textarea name="ghi_chu" placeholder="Ghi chú"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Details -->
                <div class="col-lg-6">
                    <div class="order-summary-details">
                        <h5 class="checkout-title">Tóm tắt đơn hàng</h5>
                        <div class="order-summary-content">
                            <!-- Order Summary Table -->
                            <div class="order-summary-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Products</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $Total = 0;
                                        foreach ($arrSanPham as $item): ?>
                                            <tr>
                                                <td><a href="#"><?= $item['ten_san_pham'] ?> <strong> × <?= $item['so_luong'] ?></strong></a>
                                                </td>
                                                <td><?php
                                                    if ($item['gia_khuyen_mai']) {
                                                        $cost = $item['so_luong'] * $item['gia_khuyen_mai'];
                                                        $Total += $cost;
                                                    } else {
                                                        $cost = $item['so_luong'] * $item['gia_san_pham'];
                                                        $Total += $cost;
                                                    }
                                                    echo $cost; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Total Amount</td>
                                            <td><strong><?= $Total ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- Order Payment Method -->
                            <div class="order-payment-method">
                                <?php foreach ($phuongThucThanhToans as $key => $phuongThuc): ?>
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control required" style="display: flex;">
                                                <input type="radio" id="<?= 'cashon' . $phuongThuc['id'] ?>" name="phuong_thuc_thanh_toan_id" value="<?= $phuongThuc['id'] ?>" class="custom-control-input" required>
                                                <label style="font-size: 14px; line-height: 1; padding-left: 10px;font-weight: 700; cursor: pointer;" class="custom-control-label" for="<?= 'cashon' . $phuongThuc['id'] ?>"><?= $phuongThuc['ten_phuong_thuc'] ?></label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                                <div class="summary-footer-area mt-4">
                                    <div class="custom-control mb-20" style="display: flex;">
                                        <input type="checkbox" class="custom-control-input" id="terms" required="">
                                        <label style="font-size: 14px; line-height: 1; padding-left: 10px; font-weight: 400; cursor: pointer; position: relative;" class="custom-control-label" for="terms">I have read and agree to
                                            the website <a href="index.html">terms and conditions.</a></label>
                                    </div>
                                    <button type="submit" class="btn btn-sqr" fdprocessedid="5njuad">Đặt hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <?php include './views/layout/footer.php' ?>

    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <!-- slick Slider JS -->
    <script src="assets/js/plugins/slick.min.js"></script>
    <!-- Countdown JS -->
    <script src="assets/js/plugins/countdown.min.js"></script>
    <!-- Nice Select JS -->
    <script src="assets/js/plugins/nice-select.min.js"></script>
    <!-- jquery UI JS -->
    <script src="assets/js/plugins/jqueryui.min.js"></script>
    <!-- Image zoom JS -->
    <script src="assets/js/plugins/image-zoom.min.js"></script>
    <!-- Images loaded JS -->
    <script src="assets/js/plugins/imagesloaded.pkgd.min.js"></script>
    <!-- mail-chimp active js -->
    <script src="assets/js/plugins/ajaxchimp.js"></script>
    <!-- contact form dynamic js -->
    <script src="assets/js/plugins/ajax-mail.js"></script>
    <!-- google map api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfmCVTjRI007pC1Yk2o2d_EhgkjTsFVN8"></script>
    <!-- google map active js -->
    <script src="assets/js/plugins/google-map.js"></script>
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <script>
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