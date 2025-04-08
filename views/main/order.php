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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php include './views/layout/header.php' ?>
    <?php
    if (isset($_SESSION['resultLogin']) && $_SESSION['resultLogin'] == 'error') { ?>

        <script>
            Swal.fire({
                title: 'Oops...!',
                html: '<p style="font-weight: 500; font-size: 18px">Có lỗi xảy ra, vui lòng kiểm tra lại tài khoản và mật khẩu của bạn!</p><p style="margin-top: 8px; font-size: 16px"><i>Nếu vấn đề vẫn tiếp diễn, vui lòng liên hệ với chúng tôi để được hỗ trợ.</i></p>',
                icon: 'error',
                confirmButtonText: 'Xác nhận',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            })
        </script>;

    <?php
        unset($_SESSION['resultLogin']);
    }
    ?>

    <?php
    if (isset($_SESSION['resultLogin']) && $_SESSION['resultLogin'] == 'locked') { ?>

        <script>
            Swal.fire({
                title: 'Error!',
                html: '<p style="font-weight: 500; font-size: 18px">Tài khoản của bạn đã bị khóa!</p><p style="margin-top: 8px; font-size: 16px"><i>Vui lòng liên hệ với chúng tôi để được hỗ trợ.</i></p>',
                icon: 'error',
                confirmButtonText: 'Xác nhận',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            })
        </script>;

    <?php
        unset($_SESSION['resultLogin']);
    }
    ?>

    <style>
        html ::-webkit-scrollbar {
            width: 0px;
        }
    </style>

    <main id="main">
        <section class="container mt-3 mb-5">
            <h2 class="text-center mb-3">Danh sách đơn hàng</h2>
            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($donHang as $item): ?>
                        <tr>
                            <th><?= $item['ma_don_hang'] ?></th>
                            <td><?= $item['ngay_dat'] ?></td>
                            <td><?= $item['ten_trang_thai'] ?></td>
                            <td><?= $item['tong_tien'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-danger"
                                    onclick="huyDon(<?= $item['id'] ?>)"
                                    <?= ($item['trang_thai_id'] == 9 || $item['trang_thai_id'] == 10 || $item['trang_thai_id'] == 11) ? 'disabled' : '' ?>>
                                    Hủy đơn
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <?php include './views/layout/footer.php' ?>
</body>

</html>