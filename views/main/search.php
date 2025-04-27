<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from htmldemo.net/corano/corano/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jun 2024 09:53:58 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>StylMart</title>
    <link rel="shortcut icon" href="./public/images/favicon.png" type="image/x-icon">
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS
	============================================ -->
    <!-- google fonts -->
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
    <script src="https://kit.fontawesome.com/18ea624bf8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <?php include './views/layout/header.php' ?>

    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">shop</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- page main wrapper start -->
        <div class="shop-main-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <!-- sidebar area start -->
                    <div class="col-lg-3 order-2 order-lg-1">
                        <aside class="sidebar-wrapper">
                            <!-- single sidebar start -->
                            <div class="sidebar-single">
                                <h5 class="sidebar-title">categories</h5>
                                <div class="sidebar-body">
                                    <ul class="shop-categories">
                                        <?php foreach ($listDanhMuc as $danhMuc): ?>
                                            <li><a href="<?php echo BASE_URL . '?act=category&id=' . $danhMuc['id'] ?>"><?php echo $danhMuc['ten_danh_muc'] ?></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- single sidebar end -->

                            <!-- single sidebar start -->
                            <div class="sidebar-single">
                                <h5 class="sidebar-title">price</h5>
                                <div class="sidebar-body">
                                    <div class="price-range-wrap">
                                        <div class="price-range" data-min="1" data-max="1000"></div>
                                        <div class="range-slider">
                                            <form action="#" class="d-flex align-items-center justify-content-between">
                                                <div class="price-input">
                                                    <label for="amount">Price: </label>
                                                    <input type="text" id="amount" style="max-width: none; padding: 0;">
                                                </div>
                                                <button class="filter-btn">filter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single sidebar end -->
                        </aside>
                    </div>
                    <!-- sidebar area end -->

                    <!-- shop main wrapper start -->
                    <div class="col-lg-9 order-1 order-lg-2">
                        <div class="shop-product-wrapper">
                            <!-- shop product top wrap start -->
                            <div class="shop-top-bar">
                                <div class="row align-items-center">
                                    <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    </div>
                                    <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                        <div class="top-bar-right">
                                            <div class="product-short" id="wrap-sort">
                                                <p>Sort By : </p>
                                                <select class="nice-select" name="sortby">
                                                    <option value="default">-- Sort by --</option>
                                                    <option value="name_asc">Name (A - Z)</option>
                                                    <option value="name_desc">Name (Z - A)</option>
                                                    <option value="price_asc">Price (Low > High)</option>
                                                    <option value="price_desc">Price (High > Low)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- shop product top wrap start -->

                            <!-- product item list wrapper start -->
                            <div class="shop-product-wrap grid-view row mbn-30">

                                <div id="product">
                                    <div class="content" id="product-list">
                                        <?php
                                        foreach ($listSanPham as $product) { ?>
                                            <div class="box">
                                                <div class="cart">NEW</div>
                                                <a class="img-container" href="<?php echo BASE_URL . '?act=view-detail&id=' . $product['id'] ?>">
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
                                                            <?php if (isset($product['gia_khuyen_mai'])) { ?>
                                                                <span><?= $product['gia_khuyen_mai'] ?></span>
                                                                <del><?= $product['gia_san_pham'] ?></del>
                                                            <?php   } else { ?>
                                                                <span><?= $product['gia_san_pham'] ?></span>
                                                            <?php } ?>
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
                                </div>

                            </div>
                            <!-- product item list wrapper end -->

                        </div>
                    </div>
                    <!-- shop main wrapper end -->
                </div>
            </div>
        </div>
        <!-- page main wrapper end -->
    </main>

    <?php include './views/layout/footer.php' ?>

    <!-- JS
============================================ -->

    <!-- Modernizer JS -->
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
                    if (data.length > 0) {
                        data.forEach((item) => {
                            count += item.so_luong;
                        });
                    }
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
            } else {
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
            }

            countPro();

            // let totalPrice = 0;
            // arrPro.forEach(({
            //     item
            // }) => {
            //     totalPrice += item.gia_san_pham * item.so_luong;
            // });
            // total.innerText = totalPrice;
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

        $("#wrap-sort").on('change', 'select', function() {
            var sortValue = $(this).val();
            console.log(`<?= BASE_URL . '?act=sort-by-keyword&keyword=' . $_GET['keyword'] . '&by=' ?>${sortValue}`);

            fetch(`<?= BASE_URL . '?act=sort-by-keyword&keyword=' . $_GET['keyword'] . '&by=' ?>${sortValue}`)
                .then(response => response.json())
                .then(data => {
                    let dataHtml = '';
                    data.forEach(product => {
                        dataHtml += `
                                            <div class="box">
                                                <div class="cart">NEW</div>
                                                <a class="img-container" href="?act=view-detail&id=${product.id}">
                                                    <img class="cart-img" src="${product.hinh_anh}" alt="" />
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

                                                    <div class="detail-desp">${product.ten_san_pham}</div>

                                                    <div class="detail-foot">
                                                        <div class="price">
                                                            ${product.gia_khuyen_mai ? `<span>${product.gia_khuyen_mai}</span><del>${product.gia_san_pham}</del>`
                                                                : `<span>${product.gia_san_pham}</span>`
                                                            }
                                                        </div>
                                                        <div class="add-to-cart" onClick="addProToCart({id: ${product.id}, soluong: 1})">
                                                            <i class="fa-solid fa-cart-shopping"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            `;
                    });

                    document.getElementById('product-list').innerHTML = dataHtml;
                })
                .catch(error => {
                    console.log('Error:', error);
                });
        });

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