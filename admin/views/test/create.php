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
                             <a class="btn btn-primary btn-sm" href="<?= BASE_URL_ADMIN . '?act=user' ?>">
                                 <h3 class="card-title">Back to list</h3>
                             </a>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form method="POST" enctype="multipart/form-data">
                             <div class="card-body">
                                <?php if(isset($_SESSION['errors'])): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                       <?php
                                       foreach($_SESSION['errors'] as $error): ?>
                                        <li><?=$error?></li>
                                       <?php endforeach ?>
                                       
                                    </ul>
                                </div>
                                <?php unset($_SESSION['errors']) ?>
                                <?php endif?>



                                 <div class="form-group">
                                     <label for="exampleInputFile">Ảnh đại diện</label>
                                     <div class="input-group">
                                         <div class="custom-file">

                                             <input type="file" class="custom-file-input" id="avatarInputFile" name="image[]" multiple>
                                             <label class="custom-file-label" for="avatarInputFile">Choose file</label>
                                         </div>
                                         <div class="input-group-append">
                                             <span class="input-group-text">Upload</span>
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