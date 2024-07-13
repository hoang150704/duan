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
                             <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=product' ?>">
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
                                         <div id="product_variant" style="display: none;">
                                             <div class="form-group">
                                                 <label for="exampleInputcategory_id1">Thuộc tính</label>
                                                 <select name="attribute_id" id="exampleInputcategory_id1" class="form-control" multiple>
                                                     <?php foreach ($attributes as $attribute) : ?>
                                                         <option value="<?= $attribute['id'] ?>"><?= $attribute['attribute_name'] ?></option>
                                                     <?php endforeach ?>
                                                 </select>
                                                 <p id="addAttribute" class="btn btn-success mt-3" style="display: none;">Thêm thuộc tính</p>
                                             </div>
                                         </div>
                                         <div id="variant">
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

                                                     <input type="file" class="custom-file-input" id="main_image" name="main_image" onchange="handleFileChange()" onclick="saveCurrentImage()">
                                                     <label class="custom-file-label" for="main_imageInputFile">Choose file</label>
                                                 </div>

                                                 <div class="input-group-append">
                                                     <span class="input-group-text">Upload</span>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="input-group">
                                             <img src="" width="240px" id="main_image_preview" alt="">
                                         </div>
                                         <div class="form-group">
                                             <label for="exampleInputFile">Thư viện ảnh sản phẩm</label>
                                             <div class="input-group">
                                                 <div class="custom-file">

                                                     <input type="file" class="custom-file-input" id="images" name="image[]" multiple onchange="handleFiles(this.files)">
                                                     <label class="custom-file-label" for="main_imageInputFile">Choose file</label>
                                                 </div>
                                                 <div class="input-group-append">
                                                     <span class="input-group-text">Upload</span>
                                                 </div>
                                             </div>
                                         </div>
                                         <div id="image_preview_container"></div>

                                         <div class="form-group">
                                             <label for="type">Loại sản phẩm</label>
                                             <select name="type_product" id="type" class="form-control">
                                                 <option value="1">Sản phẩm đơn giản</option>
                                                 <option value="2">Sản phẩm biến thể</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>



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
     document.addEventListener('DOMContentLoaded', function() {
         const typeSelect = document.getElementById('type');
         const productNoVariant = document.getElementById('product_no_variant');
         const productVariant = document.getElementById('product_variant');
         const addAttributeButton = document.getElementById('addAttribute');
         const variantContainer = document.getElementById('variant');
         const attributes = <?php echo json_encode($listAll); ?>;
         console.log(attributes);

         typeSelect.addEventListener('change', function() {
             if (this.value == '2') {
                 productNoVariant.style.display = 'none';
                 productVariant.style.display = 'block';
             } else {
                 productNoVariant.style.display = 'block';
                 productVariant.style.display = 'none';
             }
         });

         addAttributeButton.addEventListener('click', function() {
             const newAttributeContainer = document.createElement('div');
             newAttributeContainer.className = 'form-group';
             newAttributeContainer.innerHTML = `
                <div class="row form-group" style="margin: 0 0px 0 0px;">
                    <input type="text" value="Thuộc tính" class="col-3 form-control" placeholder="Thuộc tính">
                    <p class="col-1 "></p>
                    <input type="text" class="col-7 form-control" style="padding: 6px;" placeholder="Giá trị thuộc tính">
                    <button type="button" class="col-1 btn btn-danger btn-sm remove-attribute">X</button>
                </div>
            `;
             variantContainer.appendChild(newAttributeContainer);

             newAttributeContainer.querySelector('.remove-attribute').addEventListener('click', function() {
                 variantContainer.removeChild(newAttributeContainer);
             });
         });

         const attributeSelect = document.getElementById('exampleInputcategory_id1');
         attributeSelect.addEventListener('change', function() {
             const selectedOptions = Array.from(attributeSelect.selectedOptions).map(option => option.value);
             const existingInputs = Array.from(variantContainer.children).filter(child => child.id.startsWith('attribute_'));

             existingInputs.forEach(input => {
                 const attributeId = input.id.split('_')[1];
                 if (!selectedOptions.includes(attributeId)) {
                     variantContainer.removeChild(input);
                 }
             });

             selectedOptions.forEach(value => {
                 if (!document.getElementById(`attribute_${value}`)) {
                     const option = attributeSelect.querySelector(`option[value="${value}"]`);
                     const attributeContainer = document.createElement('div');
                     attributeContainer.className = 'form-group';
                     attributeContainer.id = `attribute_${value}`;
                     attributeContainer.innerHTML = `
                        
                    `;
                     variantContainer.appendChild(attributeContainer);

                     attributeContainer.querySelector('.remove-attribute').addEventListener('click', function() {
                         variantContainer.removeChild(attributeContainer);
                         attributeSelect.querySelector(`option[value="${attributeId}"]`).selected = false;
                     });
                 }
             });
         });
     });
 </script>