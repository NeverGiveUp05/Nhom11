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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php include './views/layout/header.php' ?>

    <style>
        html ::-webkit-scrollbar {
            width: 0px;
        }
    </style>

    <main id="main">
        <section class="container mt-3 mb-5">
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <h2>Đơn hàng: <?= $donHang[0]['ma_don_hang'] ?></h2>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <?php
                                if ($donHang[0]['trang_thai_id'] == 1) {
                                    $colorAlerts = 'primary';
                                } elseif ($donHang[0]['trang_thai_id'] >= 2 && $donHang[0]['trang_thai_id'] <= 9) {
                                    $colorAlerts = 'warning';
                                } elseif ($donHang[0]['trang_thai_id'] == 10) {
                                    $colorAlerts = 'success';
                                } else {
                                    $colorAlerts = 'danger';
                                }
                                ?>

                                <div class="alert alert-<?= $colorAlerts; ?>" role="alert">
                                    Trạng thái đơn hàng: <?= $donHang[0]['ten_trang_thai'] ?>
                                </div>
                                <!-- Main content -->
                                <div class="invoice p-3 mb-3">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fas fa-globe"></i> Shop Thời trang & Phụ kiện STYLMART
                                                <small class="float-right">Đơn hàng: <?= formatDate($donHang[0]['ngay_dat']) ?></small>
                                            </h4>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row invoice-info my-3">
                                        <!-- /.col -->
                                        <div class="col-sm-6 invoice-col">
                                            <b>Người nhận:</b> <?= $donHang[0]['ten_nguoi_nhan'] ?>
                                            <address>
                                                <b>Email:</b> <?= $donHang[0]['email_nguoi_nhan'] ?><br>
                                                <b>Số điện thoại:</b> <?= $donHang[0]['sdt_nguoi_nhan'] ?><br>
                                                <b>Địa chỉ:</b> <?= $donHang[0]['dia_chi_nguoi_nhan'] ?><br>
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6 invoice-col">
                                            <b>Mã đơn hàng:</b> <?= $donHang[0]['ma_don_hang']; ?><br>
                                            <b>Tổng tiền:</b> <?= $donHang[0]['tong_tien']; ?><br>
                                            <b>Ghi Chú:</b> <?= $donHang[0]['ghi_chu']; ?><br>
                                            <b>Thanh Toán:</b> <?= $donHang[0]['ten_phuong_thuc']; ?>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tên sản phẩm</th>
                                                        <th>Đơn giá </th>
                                                        <th>Số lượng</th>
                                                        <th>Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $tong_tien = 0; ?>
                                                    <?php foreach ($donHang as $key => $sanPham): ?>
                                                        <tr>
                                                            <td><?= $key + 1 ?></td>
                                                            <td><?= $sanPham['ten_san_pham'] ?></td>
                                                            <td><?= $sanPham['don_gia'] ?></td>
                                                            <td><?= $sanPham['san_pham_id'] ?></td>
                                                            <td><?= $sanPham['thanh_tien'] ?></td>
                                                        </tr>
                                                        <?php $tong_tien += $sanPham['thanh_tien']; ?>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="4" class="text-right"><strong>Tổng tiền:</strong></td>
                                                        <td><strong><?= $tong_tien ?></strong></td>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </div>
                                <!-- /.invoice -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
        </section>
    </main>

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
                total.innerText = 0;
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
                        data.gia_san_pham = data.gia_khuyen_mai;
                    }

                    totalPrice += data.gia_san_pham * item.so_luong;

                    main.innerHTML += `
                <div class="item-product">
                    <div class="thumb"><img src="${data.hinh_anh}" alt="" /></div>
                    <div class="container-flex">
                        <div class="info-product">
                            <h3 id="product-name">${data.ten_san_pham}</h3>
                        </div>
                        <div class="trash" onClick="removePro(${data.id}, ${item.gio_hang_id})">
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

                total.innerText = totalPrice;
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

        function huyDon(id) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn hủy đơn hàng này?',
                text: "Bạn sẽ không thể khôi phục lại đơn hàng này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("<?= BASE_URL ?>?act=handle-huydon", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                id: id,
                            })
                        })
                        .then(res => res.json())
                        .then(res => {
                            if (res.status === 'success') {
                                Swal.fire(
                                    'Đã hủy!',
                                    'Đơn hàng của bạn đã được hủy thành công.',
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Lỗi!',
                                    'Có lỗi xảy ra, vui lòng thử lại sau.',
                                    'error'
                                );
                            }
                        })
                        .catch(err => console.error("Lỗi:", err));
                }
            })
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <?php include './views/layout/footer.php' ?>
</body>

</html>