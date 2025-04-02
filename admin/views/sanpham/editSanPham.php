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
                    <h1>Sửa thông tin sản phẩm: <?= $sanPham['ten_san_pham'] ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin sản phẩm</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <form action="<?= BASE_URL_ADMIN . '?act=sua-san-pham' ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body" style="display: block;">
                            <input type="hidden" name="id_san_pham" value="<?= $sanPham['id'] ?>">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="ten_san_pham" class="form-control" value="<?= $sanPham['ten_san_pham'] ?>">
                                <?php if (isset($_SESSION['errors']['ten_san_pham'])) : ?>
                                    <span class="text-danger"><?= $_SESSION['errors']['ten_san_pham'] ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="number" class="form-control" name="gia_san_pham" value="<?= $sanPham['gia_san_pham'] ?>">
                                <?php if (isset($_SESSION['errors']['gia_san_pham'])) : ?>
                                    <span class="text-danger"><?= $_SESSION['errors']['gia_san_pham'] ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label>Giá khuyến mãi</label>
                                <input type="number" class="form-control" name="gia_khuyen_mai" value="<?= $sanPham['gia_khuyen_mai'] ?>">
                                <?php if (isset($_SESSION['errors']['gia_khuyen_mai'])) : ?>
                                    <span class="text-danger"><?= $_SESSION['errors']['gia_khuyen_mai'] ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" class="form-control" name="hinh_anh">
                            </div>

                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="number" class="form-control" name="so_luong" value="<?= $sanPham['so_luong'] ?>">
                                <?php if (isset($_SESSION['errors']['so_luong'])) : ?>
                                    <span class="text-danger"><?= $_SESSION['errors']['so_luong'] ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label>Ngày nhập</label>
                                <input type="date" class="form-control" name="ngay_nhap" value="<?= $sanPham['ngay_nhap'] ?>">
                                <?php if (isset($_SESSION['errors']['ngay_nhap'])) : ?>
                                    <span class="text-danger"><?= $_SESSION['errors']['ngay_nhap'] ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label>Danh mục</label>
                                <select class="form-control" name="danh_muc_id" id="exampleFormControlSelect1">
                                    <?php foreach ($listDanhMuc as $danhMuc): ?>
                                        <option <?= $danhMuc['id'] == $sanPham['danh_muc_id'] ? 'selected' : '' ?> value="<?= $danhMuc['id'] ?>"><?= $danhMuc['ten_danh_muc'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select class="form-control" name="trang_thai" id="exampleFormControlSelect1">
                                    <option value="1" <?= $sanPham['trang_thai'] == 1 ? 'selected' : '' ?>>Còn bán</option>
                                    <option value="2" <?= $sanPham['trang_thai'] == 2 ? 'selected' : '' ?>>Dừng bán</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" name="mo_ta"><?= $sanPham['mo_ta'] ?></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <button class="btn btn-primary">Sửa thông tin</button>
                        </div>
                </div>
                </form>
                <!-- /.card -->
            </div>
            <div class="col-md-4">
                <!-- /.card -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Album ảnh sản phẩm</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <form action="<?= BASE_URL_ADMIN . '?act=sua-album-anh-san-pham' ?>" method="post" enctype="multipart/form-data">
                            <div class="table-responsive">
                                <table id="faqs" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ảnh</th>
                                            <th>File</th>
                                            <th>
                                                <div class="text-center"><button onclick="addfaqs();" type="button" class="badge badge-success"><i class="fa fa-plus"></i> Add</button></div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                        <input type="hidden" id="img_delete" name="img_delete">
                                        <?php foreach ($listAnhSanPham as $key => $value) : ?>
                                            <tr>
                                                <td><img src="<?= BASE_URL . $value['link_hinh_anh'] ?>" style="width: 50px; height: 50px" alt=""></td>
                                                <td><input type="file" name="img_array[]" class="form-control"></td>
                                                <td class="mt-10"><button class="badge badge-danger"><i class="fa fa-trash"></i> Delete</button></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer text-center">
                                <button class="btn btn-primary">Sửa thông tin</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Save Changes" class="btn btn-success float-right">
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include './views/layout/footer.php' ?>
</body>
<script>
    var faqs_row = 0;

    function addfaqs() {
        html = '<tr id="faqs-row' + faqs_row + '">';
        html += '<td><input type="text" class="form-control" placeholder="User name"></td>';
        html += '<td><input type="file" placeholder="Product name" class="form-control"></td>';
        html += '<td class="mt-10"><button class="badge badge-danger" onclick="$(\'#faqs-row' + faqs_row + '\').remove();"><i class="fa fa-trash"></i> Delete</button></td>';

        html += '</tr>';

        $('#faqs tbody').append(html);

        faqs_row++;
    }
</script>

</html>