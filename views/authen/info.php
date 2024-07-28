<hr style="margin-bottom: 0;">
<div style="background-color: #f4f6f9;padding: 30px;">
    <div class="container">
        <div class="content-wrapper" style="margin: 0;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                        <div class="col-sm-12">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Thông tin cá nhân</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="<?= BASE_URL . $_SESSION['user']['avatar'] ?>" alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center"><?= $_SESSION['user']['username'] ?></h3>


                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Tên đăng nhập: </b><b class=""><?= $_SESSION['user']['username'] ?></b>

                                        </li>
                                        <li class="list-group-item">
                                            <b>Họ và tên: </b>
                                            <?php if ($_SESSION['user']['fullname'] == '' || empty($_SESSION['user']['fullname']) || $_SESSION['user']['fullname'] == null) : ?>
                                                <a href="<?= BASE_URL . '?act=update-user' ?>">Thêm</a>
                                            <?php else : ?>
                                                <b class=""><?= $_SESSION['user']['fullname'] ?></b>
                                            <?php endif ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Số điện thoại: </b>
                                            <?php if ($_SESSION['user']['phone'] == '' || $_SESSION['user']['phone'] == null) : ?>
                                                <a href="<?= BASE_URL . '?act=update-user' ?>">Thêm</a>
                                            <?php else : ?>
                                                <b class=""><?= mask_phone($_SESSION['user']['phone']) ?></b>
                                            <?php endif ?>

                                        </li>
                                        <li class="list-group-item">
                                            <b>Email: </b> <b class=""><?= mask_email($_SESSION['user']['email']) ?></b> <a href="<?= BASE_URL . '?act=change-email&check=1' ?>">Sửa</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Địa chỉ: </b>
                                            <?php if ($_SESSION['user']['address'] == '' || $_SESSION['user']['address'] == null) : ?>
                                                <a href="<?= BASE_URL . '?act=update-user' ?>">Thêm</a>
                                            <?php else : ?>
                                                <b class=""><?= $_SESSION['user']['address'] ?></b>
                                            <?php endif ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Ngày đăng kí: </b> <b class=""><?= $_SESSION['user']['create_date'] ?></b>
                                        </li>
                                    </ul>
                                    <a href="<?= BASE_URL . '?act=update-user' ?>" class="btn btn-primary btn-block"><b>Sửa thông tin</b></a>
                                    <a href="<?= BASE_URL . '?act=change-password' ?>" class="btn btn-warning btn-block"><b>Đổi mật khẩu</b></a>
                                    <a href="<?= BASE_URL . '?act=logout' ?>" class="btn btn-danger btn-block"><b>Đăng xuất</b></a>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Bình luận</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Đơn hàng</a></li>

                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <!-- Post -->
                                            <?php foreach ($comments as $comment) : ?>
                                                <div class="post">
                                                    <div class="user-block">
                                                        <img class="img-circle img-bordered-sm" src="<?= BASE_URL . $_SESSION['user']['avatar'] ?>" alt="user image">
                                                        <span class="username">
                                                            <a href="#"><?= $_SESSION['user']['fullname'] ?></a>

                                                        </span>
                                                        <span class="description">Bình luận ngày - <?= $comment['date_comment'] ?></span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p><?= $comment['comment_content'] ?></p>

                                                    <p>
                                                        <?php if ($comment['reply'] == null) : ?>
                                                    <p></p>
                                                <?php else : ?>
                                                    <p class="alert alert-success">Admin: <?= $comment['reply'] ?></p>

                                                <?php endif ?>
                                                </p>
                                                </div>
                                            <?php endforeach ?>
                                            <!-- /.post -->

                                            <!-- /.post -->
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="timeline">
                                            <div class="card">
                                                <div class="card-header p-2">
                                                    <ul class="nav nav-pills">
                                                        <?php foreach ($statusOrders as $statusOrder) : ?>
                                                            <li class="nav-item"><a class="nav-link <?php $kq = ($statusOrder['id'] == 1) ? "active" : "";
                                                                                                    echo $kq ?>" href="#settings<?= $statusOrder['id'] ?>" data-toggle="tab"><?= $statusOrder['status_order_name'] ?></a></li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                </div><!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="tab-content">
                                                        <?php foreach ($combinedData as $key=>$value) : ?>
                                                            <div class="tab-pane <?php echo ($key == 1) ? "active" : ""; ?>" id="settings<?= $value['status']['id'] ?>">
                                                                <!-- Content -->
                                                                 <?php foreach($value['orders'] as $order): ?>
                                                               <div class="row d-flex justify-content-between">
                                                                <div class="col">
                                                                    <?=$order['total_money']?>
                                                                </div>
                                                               </div>
                                                               <?php endforeach ?>
                                                            <!-- end content -->
                                                            </div>
                                                        <?php endforeach ?>
                                                    </div>
                                                    <!-- /.tab-content -->
                                                </div><!-- /.card-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
</div>
<hr style="margin-top: 0;">