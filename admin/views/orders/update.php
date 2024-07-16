<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php require_once PATH_VIEW_ADMIN . 'layouts/components/breadcrumb.php'; ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=order' ?>">
                                <h3 class="card-title">Back to list</h3>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <?php if (isset($_SESSION['success'])) : ?>
                                    <div class="d-flex align-items-center alert alert-success">
                                        <i class="fas fa-check-circle"></i>
                                        <p class="p-2 m-0"><?= $_SESSION['success'] ?></p>
                                    </div>
                                    <?php unset($_SESSION['success']) ?>
                                <?php endif ?>
                                <?php if (isset($_SESSION['errors'])) : ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php foreach ($_SESSION['errors'] as $error) : ?>
                                                <li><?= $error ?></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                    <?php unset($_SESSION['errors']) ?>
                                <?php endif ?>
                                <div class="row">
                                    <div class="col-6 border">
                                        <h5><b>Thông tin người nhận:</b></h5>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Họ và tên</label>
                                            <input type="text" class="form-control" id="order_account_name" name="order_account_name" value="<?= $order['order_account_name'] ?>">
                                            <span></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Số điện thoại</label>
                                            <input type="text" class="form-control" id="order_phone" placeholder="Số điện thoại" name="order_phone" value="<?= $order['order_phone'] ?>">
                                            <span></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Địa chỉ</label>
                                            <input type="text" class="form-control" id="order_address" placeholder="Địa chỉ" name="order_address" value="<?= $order['order_address'] ?>">
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="col-6 border">
                                        <h5><b>Chung:</h5>
                                        <div class="form-group">
                                            <label for="status_id">Trạng thái đơn hàng</label>
                                            <select name="status_id" id="status_id" class="form-control">
                                                <?php foreach ($status_orders as $status_order) : ?>
                                                    <option value="<?= $status_order['id'] ?>" <?php if ($order['status_id'] == $status_order['id']) echo 'selected'; ?>><?= $status_order['status_order_name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFullName1">Phí ship</label>
                                            <input type="text" class="form-control" id="shippingFee" placeholder="Phí ship" name="shipping" value="<?= $order['shipping'] ?>" onchange="updateShippingFee()">
                                            <span></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputAddress1">Ghi chú</label>
                                            <input type="text" class="form-control" id="note" placeholder="Ghi chú ....." name="note" value="<?= $order['note'] ?>">
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row border mt-3">
                                    <div class="col">
                                        <table id="example2" class="table table-hover border mt-3">
                                            <tr class="bg-secondary">
                                                <th>Sản phẩm</th>
                                                <th>Chi phí</th>
                                                <th>Số lượng</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                            <?php
                                            $i = 0;
                                            foreach ($details as $detail) :
                                            ?>
                                                <tr class="bg-light">
                                                    <td><?= $detail['product_name'] ?></td>
                                                    <td><?= $detail['product_price'] ?> VND</td>
                                                    <td><input  type="number" name="detail_quantity[]" id="quantity<?= $i ?>" value="<?= $detail['detail_quantity'] ?>" onchange="updateTotal(<?= $i ?>, <?= $detail['product_price'] ?>)"></td>
                                                    <td id="total<?= $i ?>"> <?= $detail['product_price'] * $detail['detail_quantity'] ?> VND</td>
                                                </tr>
                                            <?php
                                                $i++;
                                            endforeach
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <p id="subtotal">Tạm tính:  VND</p>
                                                    <p id="ship">Phí ship: <?= $order['shipping'] ?> VND</p>
                                                  
                                                <p>Thành tiền: </p>    
                                                <input type="text" class="form-control" id="total_money" name="total_money" readonly> 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </div>
                        </form>
                        <!-- END FORM -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script>
function updateTotal(index, price) {
    var quantity = document.getElementById('quantity' + index).value;
    var total = price * quantity;
    document.getElementById('total' + index).innerText = total + ' VND';

    updateSubtotal();
}

function updateShippingFee() {
    var shippingFee = parseInt(document.getElementById('shippingFee').value) || 0;
    document.getElementById('ship').innerText = 'Phí ship: ' + shippingFee + ' VND';

    updateSubtotal();
}

function updateSubtotal() {
    var rows = document.querySelectorAll('table tr.bg-light');
    var subtotal = 0;

    rows.forEach(function(row, index) {
        var total = parseInt(document.getElementById('total' + index).innerText.replace(' VND', ''));
        subtotal += total;
    });

    document.getElementById('subtotal').innerText = 'Tạm tính: ' + subtotal + ' VND';

    var shippingFee = parseInt(document.getElementById('shippingFee').value) || 0;
    document.getElementById('ship').innerText = 'Phí ship: ' + shippingFee + ' VND';

    var totalMoney = subtotal + shippingFee;
    document.getElementById('total_money').value =  totalMoney ;
}

// Update the total values initially
updateSubtotal();

</script>
<select name="status_id" id="status_id" class="form-control">
    <?php foreach ($status_orders as $status_order) : ?>
        <option value="<?= $status_order['id'] ?>" <?php if ($order['status_id'] == $status_order['id']) echo 'selected'; ?>><?= $status_order['status_order_name'] ?></option>
    <?php endforeach ?>
</select>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var statusSelect = document.getElementById('status_id');
    var currentStatus = <?= $order['status_id'] ?>;
    
    if (currentStatus == 3) { // Đơn hàng đã hoàn thành
        for (var i = 0; i < statusSelect.options.length; i++) {
            if (statusSelect.options[i].value != 3) {
                statusSelect.options[i].disabled = true;
            }
        }
    }
});
</script>
