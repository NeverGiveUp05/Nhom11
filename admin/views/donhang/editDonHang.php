<?php include './views/layout/header.php' ?>

<!-- Navbar -->
<?php include './views/layout/navbar.php' ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php' ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa thông tin đơn hàng: <?= $donHang['ma_don_hang'] ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sửa danh mục sản phẩm</h3>
                        </div>

                        <form action="<?= BASE_URL_ADMIN . '?act=sua-don-hang' ?>" method="POST">
                            <input type="text" name="don_hang_id" value="<?= $donHang['id'] ?>" hidden>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tên người nhận</label>
                                    <input type="text" class="form-control" name="ten_nguoi_nhan" value="<?= $donHang['ten_nguoi_nhan'] ?>" placeholder="Nhập tên người nhận">
                                    <?php if (isset($error['ten_nguoi_nhan'])) : ?>
                                        <span class="text-danger"><?= $error['ten_nguoi_nhan'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" name="sdt_nguoi_nhan" value="<?= $donHang['sdt_nguoi_nhan'] ?>" placeholder="Nhập số điện thoại người nhận">
                                    <?php if (isset($error['sdt_nguoi_nhan'])) : ?>
                                        <span class="text-danger"><?= $error['sdt_nguoi_nhan'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Email </label>
                                    <input type="text" class="form-control" name="email_nguoi_nhan" value="<?= $donHang['email_nguoi_nhan'] ?>" placeholder="Nhập email chỉ người nhận">
                                    <?php if (isset($error['email_nguoi_nhan'])) : ?>
                                        <span class="text-danger"><?= $error['email_nguoi_nhan'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="dia_chi_nguoi_nhan" value="<?= $donHang['dia_chi_nguoi_nhan'] ?>" placeholder="Nhập địa chỉ người nhận">
                                    <?php if (isset($error['dia_chi_nguoi_nhan'])) : ?>
                                        <span class="text-danger"><?= $error['dia_chi_nguoi_nhan'] ?></span>
                                    <?php endif; ?>
                                </div>


                                <div class="form-group">
                                    <label>Ghi chú</label>
                                    <textarea class="form-control" name="ghi_chu" placeholder="Nhập ghi chu"><?= $donHang['ghi_chu'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Trạng thái đơn hàng</label>
                                    <select class="form-control" name="trang_thai_id" id="exampleFormControlSelect1">
                                        <?php foreach ($listTrangThaiDonHang as $trangThai): ?>
                                            <option
                                                <?php
                                                if (
                                                    $donHang['trang_thai_id'] > $trangThai['id']
                                                    || $donHang['trang_thai_id'] == 9
                                                    || $donHang['trang_thai_id'] == 10
                                                    || $donHang['trang_thai_id'] == 11
                                                ) {
                                                    echo 'disabled';
                                                }
                                                ?>
                                                <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?>
                                                value="<?= $trangThai['id'] ?>">
                                                <?= $trangThai['ten_trang_thai'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include './views/layout/footer.php' ?>
</body>

</html>