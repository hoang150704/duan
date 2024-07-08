 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <?php
        require_once PATH_VIEW_ADMIN . 'layouts/components/breadcrumb.php';
        ?>

     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <!-- left column -->
                 <div class="col-md-12">
                     <!-- general form elements -->
                     <div class="card card-primay">
                         <div class="card-header">
                             <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=prodcut' ?>">
                                 <h3 class="card-title">Back to list</h3>
                             </a>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form method="POST" enctype="multipart/form-data">
                             <div class="card-body">
                                 <?php if (isset($_SESSION['errors'])) : ?>
                                     <div class="alert alert-danger">
                                         <ul>
                                             <?php
                                                foreach ($_SESSION['errors'] as $error) : ?>
                                                 <li><?= $error ?></li>
                                             <?php endforeach ?>

                                         </ul>
                                     </div>
                                     <?php unset($_SESSION['errors']) ?>
                                 <?php endif ?>

                                 <div class="row">
                                     <div class="col-9">
                                         <div class="form-group">

                                             <input type="text" class="form-control" id="exampleInputproduct_name1" placeholder="Tên sản phẩm" name="product_name" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['product_name'] : '' ?>">
                                             <span></span>
                                         </div>
                                         <div class="">
                                             <label for="content" class="form-label">Mô tả</label>
                                             <textarea name="des" id="content"></textarea>
                                             <span></span>
                                         </div>
                                     </div>
                                     <div class="col-3 border rounded">
                                         <div class="form-group">
                                             <label for="exampleInputcategory_id1">Danh mục</label>
                                             <select name="category_id" id="exampleInputcategory_id1" class="form-control">
                                                 <?php foreach ($categories as $category) : ?>
                                                     <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
                                                 <?php endforeach ?>
                                             </select>
                                         </div>
                                         <div class="form-group">
                                             <label for="exampleInputFile">Ảnh đại diện sản phẩm</label>
                                             <div class="input-group">
                                                 <div class="custom-file">

                                                     <input type="file" class="custom-file-input" id="main_imageInputFile" name="main_image">
                                                     <label class="custom-file-label" for="main_imageInputFile">Choose file</label>
                                                 </div>
                                                 <div class="input-group-append">
                                                     <span class="input-group-text">Upload</span>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="exampleInputFile">Thư viện ảnh sản phẩm</label>
                                             <div class="input-group">
                                                 <div class="custom-file">

                                                     <input type="file" class="custom-file-input" id="main_imageInputFile" name="image[]" multiple>
                                                     <label class="custom-file-label" for="main_imageInputFile">Choose file</label>
                                                 </div>
                                                 <div class="input-group-append">
                                                     <span class="input-group-text">Upload</span>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="type">Loại sản phẩm</label>
                                             <select name="category_id" id="type" class="form-control">
                                                 <option value="1">Sản phẩm đơn giản</option>
                                                 <option value="2">Sản phẩm biến thể</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div id="product_no_variant" style="display: block;">
                                     <div class="form-group">
                                         <label for="price">Giá thường</label>
                                         <input type="number" class="form-control" id="price" placeholder="Giá sản phẩm" name="price" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['product_name'] : '' ?>">
                                         <span></span>
                                     </div>
                                     <div class="form-group">
                                         <label for="sale_price">Giá ưu đãi</label>
                                         <input type="number" class="form-control" id="sale_price" placeholder="Giá ưu đãi" name="sale_price" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['product_name'] : '' ?>">
                                         <span></span>
                                     </div>
                                     <div class="form-group">
                                         <label for="quantity">Số lượng</label>
                                         <input type="number" class="form-control" id="quantity" placeholder="Số lượng sản phẩm" name="quantity" value="<?= isset($_SESSION['data']) ? $_SESSION['data']['product_name'] : '' ?>">
                                         <span></span>
                                     </div>
                                 </div>

                                 <div id="variant"></div>

                             </div>
                             <!-- /.card-body -->

                             <div class="card-footer ">
                                 <button type="submit" class="btn btn-primary " name="submit">Submit</button>
                             </div>
                         </form>
                         <!-- END FORM -->

                     </div>
                     <!-- /.card -->


                 </div>

             </div>
             <!-- /.row -->
         </div><!-- /.container-fluid -->
     </section>
     <?php unset($_SESSION['data']) ?>
     <!-- /.content -->
 </div>
 <script>
     document.getElementById('type').addEventListener('change', function() {
         var variantOptionsDiv = document.getElementById('variant-options');
         if (this.value == '2') {
             variantOptionsDiv.innerHTML = `
                    <div class="form-group">
                        <label for="variant">Biến thể</label>
                        <select name="variant_id" id="variant" class="form-control">
                            <option value="1">Màu sắc</option>
                            <option value="2">Kích thước</option>
                        </select>
                    </div>
                `;
         } else {
             variantOptionsDiv.innerHTML = '';
         }
     });
 </script>