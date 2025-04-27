<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StylMart</title>
    <link rel="shortcut icon" href="./public/images/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="./public/css/cart.css">
    <script src="https://kit.fontawesome.com/18ea624bf8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    if (isset($_SESSION['resultRegister']) && $_SESSION['resultRegister'] == 'success') {
    ?>
        <script>
            let timerInterval;

            Swal.fire({
                title: 'Success!',
                html: 'Đăng ký thành công! Về trang chủ sau: <b>3</b> giây.',
                icon: 'success',
                confirmButtonText: 'Xác nhận',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    const b = Swal.getHtmlContainer().querySelector('b');
                    let timeLeft = 3;
                    timerInterval = setInterval(() => {
                        timeLeft -= 1;

                        b.textContent = timeLeft;
                    }, 1000);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then(() => {
                window.location.href = "<?php echo BASE_URL ?>";
            });
        </script>
    <?php
        unset($_SESSION['resultRegister']);
    };
    ?>

    <?php
    if (isset($_SESSION['resultRegister']) && $_SESSION['resultRegister'] == 'error') {
    ?>
        <script>
            Swal.fire({
                title: 'Oops...!',
                html: '<p style="font-weight: 500; font-size: 18px">Email hoặc số điện thoại đã tồn tại!',
                icon: 'error',
                confirmButtonText: 'Xác nhận',
            })
        </script>
    <?php
        unset($_SESSION['resultRegister']);
    } ?>

    <?php include './views/layout/header.php' ?>

    <main id="main">
        <section class="container">
            <h3 class="text-uppercase pt-4 text-center">Đăng ký</h3>

            <form class="row g-3 needs-validation mt-1" novalidate method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL . '?act=user-register' ?>">
                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Email:<span style="color: red;">*</span></label>
                    <input type="email" class="form-control p-2" id="validationCustom01" required name="email">
                    <div id="emailError" class="invalid-feedback">
                        Vui lòng cung cấp địa chỉ email
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="inputPassword" class="form-label">Mật khẩu:<span style="color: red;">*</span></label>
                    <input autocomplete="off" type="password" class="form-control p-2" id="inputPassword" required name="mat_khau">
                    <div class="invalid-feedback">
                        Vui lòng cung cấp mật khẩu
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="inputRePassword" class="form-label">Xác nhận mật khẩu:<span style="color: red;">*</span></label>
                    <input autocomplete="off" type="password" class="form-control p-2" id="inputRePassword" required>
                    <div class="invalid-feedback" id="rePassword">
                        Vui lòng xác nhận mật khẩu
                    </div>
                    <div class="invalid-feedback d-none" id="rePasswordError">
                        Xác nhận mật khẩu không khớp
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Họ tên:<span style="color: red;">*</span></label>
                    <input type="text" class="form-control p-2" id="validationCustom04" required name="ho_ten">
                    <div class="invalid-feedback">
                        Vui lòng cung cấp họ tên
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="validationCustom05" class="form-label">Số điện thoại:<span style="color: red;">*</span></label>
                    <input type="number" class="form-control p-2" id="validationCustom05" required name="so_dien_thoai">
                    <div class="invalid-feedback">
                        Vui lòng cung cấp số điện thoại
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Địa chỉ:<span style="color: red;">*</span></label>
                    <input type="text" class="form-control p-2" id="validationCustom04" required name="dia_chi">
                    <div class="invalid-feedback">
                        Vui lòng cung cấp địa chỉ
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Ngày sinh:</label>
                    <input type="date" class="form-control p-2" id="validationCustom04" name="ngay_sinh">
                </div>

                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Giới tính:</label>
                    <select name="gioi_tinh" id="" class="form-select p-2" required>
                        <option selected disabled>Chọn giới tính</option>
                        <option value="1">Nam</option>
                        <option value="2">Nữ</option>
                        <option value="0">Khác</option>
                    </select>
                    <div class="invalid-feedback">
                        Vui lòng cung cấp gioi tinh
                    </div>
                </div>

                <div class="col-md-3">
                    <label style="position: relative;" for="validationCustom06" class="form-label">Ảnh đại diện:
                        <img style="display: inline-block; border-radius: 50%; position: absolute; top: 0; left: 340%; width: 100px; height: 100px" id="image-preview" class="d-none" width="100" alt="">
                    </label>
                    <input type="file" class="form-control" id="validationCustom06" name="anh_dai_dien" onchange="previewImage(this.files[0])">
                </div>

                <div class="col-12 mt-4 mb-5 screen-end">
                    <button name="submit" style="width: 224px;" class="btn btn--large register-btn" fdprocessedid="icvugw">Đăng ký</button>
                </div>

            </form>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        const emailInput = document.getElementById('validationCustom01');
        const emailError = document.getElementById('emailError');
        let checkEmail = false;

        function previewImage(file) {
            const previewImage = document.getElementById('image-preview');
            previewImage.classList.remove('d-none');
            previewImage.src = URL.createObjectURL(file);
        }

        emailInput.addEventListener('input', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value)) {
                emailInput.classList.add('invalid');
                emailError.style.display = 'block';
                checkEmail = false;
            } else {
                emailInput.classList.remove('invalid');
                emailError.style.display = 'none';
                checkEmail = true;
            }
        });

        (() => {
            'use strict'

            const forms = document.querySelectorAll('.needs-validation')
            const inputPassword = document.getElementById('inputPassword')
            const inputRePassword = document.getElementById('inputRePassword')
            const rePassword = document.getElementById('rePassword')
            const rePasswordError = document.getElementById('rePasswordError')

            inputPassword.addEventListener('input', function() {
                if (inputPassword.value !== inputRePassword.value) {
                    inputRePassword.classList.add('invalid');
                    rePassword.classList.add('d-none');
                    rePasswordError.classList.remove('d-none');
                    rePasswordError.style.display = 'block';
                } else {
                    inputRePassword.classList.remove('invalid');
                    rePassword.classList.remove('d-none');
                    rePasswordError.classList.add('d-none');
                    rePasswordError.style.display = 'none';
                }
            })

            inputRePassword.addEventListener('input', function() {
                if (inputPassword.value !== inputRePassword.value) {
                    inputRePassword.classList.add('invalid');
                    rePassword.classList.add('d-none');
                    rePasswordError.classList.remove('d-none');
                    rePasswordError.style.display = 'block';
                } else {
                    inputRePassword.classList.remove('invalid');
                    rePassword.classList.remove('d-none');
                    rePasswordError.classList.add('d-none');
                    rePasswordError.style.display = 'none';
                }
            })

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    if (inputPassword.value !== inputRePassword.value) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    if (checkEmail == false) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })

        })()
    </script>

    <?php include './views/layout/footer.php' ?>
</body>

</html>