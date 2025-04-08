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
        <section class="container">
            <div class="auth">
                <div class="auth-container">
                    <div class="auth-row">
                        <div class="auth__login auth__block">
                            <h3 class="auth__title">Bạn đã có tài khoản IVY</h3>
                            <div class="auth__login__content">
                                <p class="auth__description">
                                    Nếu bạn đã có tài khoản, hãy đăng nhập để tích lũy điểm thành viên và nhận được
                                    những ưu đãi tốt hơn!
                                </p>
                                <form id="login-form" class="auth__form login-form" role="login" name="frm_customer_account_email" enctype="application/x-www-form-urlencoded" method="post" action="<?= BASE_URL . '?act=user-login' ?>">
                                    <div class="form-group">
                                        <input class="form-control" name="account" type="text" placeholder="Email / SĐT" required />
                                    </div>
                                    <div class="form-group" style="position: relative;">
                                        <input id="passwordIp" class="form-control" name="password" type="password" autocomplete="off" placeholder="Mật khẩu" style="padding-right: 40px;" required />

                                        <i class="fa-regular fa-eye-slash eye"></i>
                                    </div>
                                    <div class="auth__form__options">
                                        <div class="form-checkbox">
                                            <label>
                                                <input class="checkboxs" value="1" name="customer_remember" type="checkbox" />
                                                <span style="margin-left: 5px"> Ghi nhớ đăng nhập</span>
                                            </label>
                                        </div>
                                        <a class="auth__form__link" href="#">Quên mật khẩu?
                                        </a>
                                    </div>
                                    <div class="auth__form__options">
                                        <a class="auth__form__link login-with-qr" href="#">Đăng nhập bằng mã QR</a>
                                        <a class="auth__form__link" href="#">Đăng nhập bằng OTP</a>
                                    </div>
                                    <div class="auth__form__buttons">
                                        <button id="but_login_email" name="login" class="btn btn--large g-recaptcha" data-sitekey="6Lcy5uEmAAAAADhosFdXQK6Em8axmw6Um7m4mnU5" data-callback="onSubmitLogin">
                                            Đăng nhập
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="auth__register auth__block">
                            <h3 class="auth__title">Khách hàng mới của IVY moda</h3>
                            <div class="auth__login__content">
                                <p class="auth__description">
                                    Nếu bạn chưa có tài khoản trên ivymoda.com, hãy sử dụng tùy chọn này để truy cập
                                    biểu mẫu đăng ký.
                                </p>
                                <p class="auth__description">
                                    Bằng cách cung cấp cho IVY moda thông tin chi tiết của bạn, quá trình mua hàng
                                    trên ivymoda.com sẽ là một trải nghiệm thú vị và nhanh chóng hơn!
                                </p>

                                <div class="auth__form__buttons">
                                    <a href="?act=register">
                                        <button class="btn btn--large">Đăng ký</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        const eye = document.querySelector('.eye');
        const passwordIp = document.getElementById('passwordIp');

        eye.addEventListener('click', function() {
            eye.classList.toggle('fa-eye');
            eye.classList.toggle('fa-eye-slash');

            if (eye.classList.contains('fa-eye')) {
                passwordIp.type = 'text';
            } else {
                passwordIp.type = 'password';
            }
        })

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

    <?php include './views/layout/footer.php' ?>
</body>

</html>