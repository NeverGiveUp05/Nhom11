<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./public/css/style.css">
    <script src="https://kit.fontawesome.com/18ea624bf8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include './views/layout/header.php' ?>

    <!-- body -->

    <main id="main">
        <div class="container">
            <div class="nav infinite-slider">
                <div class="nav-info left-nav">
                    <a href="#"><span>SALE all 50% + thêm 10% HĐ từ 2 SP</span></a>
                </div>
                <div class="nav-info center-nav">
                    <a href="#"><span>SALE UPTO 75% </span></a>
                </div>
                <div class="nav-info right-nav">
                    <a href="#"><span>NEW ARRIVAL + giảm 10% HĐ từ 2 SP</span></a>
                </div>
            </div>

            <section id="banner">
                <div class="wrapper">
                    <i class="fa-solid fa-arrow-left-long arrow-left" onClick="prev()"></i>

                    <img id="slide-img" src="./public/images/banner2.jpg" alt="" />

                    <div id="slide-banner">
                        <img class="slide-img" src="./public/images/banner2.jpg" alt="" />
                        <img class="slide-img" src="./public/images/banner3.png" alt="" />
                        <img class="slide-img" src="./public/images/banner4.jpg" alt="" />
                    </div>

                    <i class="fa-solid fa-arrow-right-long arrow-right" onClick="next()"></i>

                    <div id="list-dot">
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                    </div>
                </div>
            </section>

            <section id="product">
                <div class="title-section">NEW ARRIVAL</div>
                <div class="wrap">
                    <div class="head">
                        <ul>
                            <?php
                            foreach ($listDanhMuc as $key => $value) { ?>
                                <?php if ($key == 0) { ?>
                                    <li class='tab active'>
                                        <?php echo $value['ten_danh_muc'] ?>
                                    </li>
                                <?php   } else { ?>
                                    <li class='tab' onClick='changeDanhMuc(<?php echo $value["id"] ?>)'>
                                        <?php echo $value['ten_danh_muc'] ?>
                                    </li>
                            <?php }
                            } ?>
                        </ul>
                    </div>

                    <div class="content">

                        <?php
                        foreach ($listSanPham as $product) { ?>
                            <div class="box">
                                <div class="cart">NEW</div>
                                <a class="img-container" href="<?php echo BASE_URL . '/?act=viewDetail&detail=' . $product['id'] ?>">
                                    <img class="cart-img" src="<?php echo $product['hinh_anh'] ?>" alt="" />
                                    <!-- <img class="pseudo-img" src="" alt="" /> -->
                                </a>

                                <div class="detail">
                                    <div class="detail-head">
                                        <div class="list-color">
                                            <div class="color color-c5a782"></div>
                                            <div class="color color-a3784e"></div>
                                            <div class="color color-ec6795 checked"></div>
                                        </div>
                                        <div class="heart">
                                            <i class="fa-regular fa-heart"></i>
                                        </div>
                                    </div>

                                    <div class="detail-desp"><?php echo $product['ten_san_pham'] ?></div>

                                    <div class="detail-foot">
                                        <div class="price">
                                            <span><?= $product['gia_san_pham'] ?></span>
                                            <?php if (isset($product['gia_khuyen_mai']) && $product['gia_khuyen_mai'] !== 0) { ?>
                                                <del><?= $product['gia_khuyen_mai'] ?></del>
                                            <?php   } ?>
                                        </div>
                                        <div class="add-to-cart" onClick="addProToCart({id: <?php echo $product['id'] ?>, soluong: 1})">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php    }
                        ?>

                    </div>
                    <div class="show-all">
                        <a href="<?php echo '?act=category&list=';
                                    if (isset($_GET['list'])) {
                                        echo $_GET['list'];
                                    } else {
                                        echo $ds[0]['id'];
                                    } ?>" id="more-pro" class="show-text">Xem thêm</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        let scroll = localStorage.getItem('scroll');

        if (scroll) {
            window.scrollTo(0, scroll);

            localStorage.removeItem('scroll');
        }

        function change(maLoaiHang) {

            let currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;

            localStorage.setItem('scroll', currentScrollPosition);

            window.location.href = '?list=' + maLoaiHang;
        }

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

    <script src="./public/js/banner.js"></script>

    <?php include './views/layout/footer.php' ?>
</body>

</html>