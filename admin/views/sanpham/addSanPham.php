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
                    <h1>Quản lý sản phẩm</h1>
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
                            <h3 class="card-title">Thêm sản phẩm</h3>
                        </div>

                        <form action="<?= BASE_URL_ADMIN . '?act=them-san-pham' ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body row">
                                <div class="form-group col-12">
                                    <label>Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="ten_san_pham" placeholder="Nhập tên sản phẩm">
                                    <?php if (isset($_SESSION['errors']['ten_san_pham'])) : ?>
                                        <span class="text-danger"><?= $_SESSION['errors']['ten_san_pham'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Giá sản phẩm</label>
                                    <input type="number" class="form-control" name="gia_san_pham" placeholder="Nhập giá sản phẩm">
                                    <?php if (isset($_SESSION['errors']['gia_san_pham'])) : ?>
                                        <span class="text-danger"><?= $_SESSION['errors']['gia_san_pham'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Giá khuyến mãi</label>
                                    <input type="number" class="form-control" name="gia_khuyen_mai" placeholder="Nhập giá khuyến mãi">
                                    <?php if (isset($_SESSION['errors']['gia_khuyen_mai'])) : ?>
                                        <span class="text-danger"><?= $_SESSION['errors']['gia_khuyen_mai'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Hình ảnh</label>
                                    <input type="file" class="form-control" name="hinh_anh">
                                    <?php if (isset($_SESSION['errors']['hinh_anh'])) : ?>
                                        <span class="text-danger"><?= $_SESSION['errors']['hinh_anh'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Album ảnh</label>
                                    <input type="file" class="form-control" name="img_array[]" multiple>
                                </div>

                                <div class="form-group col-6">
                                    <label>Số lượng</label>
                                    <input type="number" class="form-control" name="so_luong" placeholder="Nhập số lượng">
                                    <?php if (isset($_SESSION['errors']['so_luong'])) : ?>
                                        <span class="text-danger"><?= $_SESSION['errors']['so_luong'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Ngày nhập</label>
                                    <input type="date" class="form-control" name="ngay_nhap" placeholder="Nhập ngày nhập">
                                    <?php if (isset($_SESSION['errors']['ngay_nhap'])) : ?>
                                        <span class="text-danger"><?= $_SESSION['errors']['ngay_nhap'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Danh mục</label>
                                    <select class="form-control" name="danh_muc_id" id="exampleFormControlSelect1">
                                        <option selected disabled>Chọn danh mục sản phẩm</option>
                                        <?php foreach ($listDanhMuc as $danhMuc): ?>
                                            <option value="<?= $danhMuc['id'] ?>"><?= $danhMuc['ten_danh_muc'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <?php if (isset($_SESSION['errors']['danh_muc_id'])) : ?>
                                        <span class="text-danger"><?= $_SESSION['errors']['danh_muc_id'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-6">
                                    <label>Trạng thái</label>
                                    <select class="form-control" name="trang_thai" id="exampleFormControlSelect1">
                                        <option selected disabled>Chọn trạng thái sản phẩm</option>
                                        <option value="1">Còn bán</option>
                                        <option value="2">Dừng bán</option>
                                    </select>
                                    <?php if (isset($_SESSION['errors']['trang_thai'])) : ?>
                                        <span class="text-danger"><?= $_SESSION['errors']['trang_thai'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-12">
                                    <label>Mô tả</label>
                                    <textarea class="form-control" name="mo_ta" placeholder="Nhập mô tả"></textarea>
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