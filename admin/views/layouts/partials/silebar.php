<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= BASE_URL ?>assets/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
        
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="<?= BASE_URL_ADMIN ?>" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>

                </li>
                <!-- User -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= BASE_URL_ADMIN . '?act=user' ?>" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Tất cả tài khoản</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= BASE_URL_ADMIN . '?act=user-create' ?>" class="nav-link">
                                <i class="fas fa-plus nav-icon" style="color: #ffffff;"></i>
                                <p>Thêm tài khoản</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- Danh mục -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Danh mục
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= BASE_URL_ADMIN . '?act=category' ?>" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Tất cả danh mục</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= BASE_URL_ADMIN . '?act=category-create' ?>" class="nav-link">
                                <i class="fas fa-plus nav-icon" style="color: #ffffff;"></i>
                                <p>Thêm danh mục</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- THuộc tính -->
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-jira"></i>
                        <p>
                            Thuộc tính
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= BASE_URL_ADMIN . '?act=attribute' ?>" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Tất cả thuộc tính</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= BASE_URL_ADMIN . '?act=attribute-create' ?>" class="nav-link">
                                <i class="fas fa-plus nav-icon" style="color: #ffffff;"></i>
                                <p>Thêm thuộc tính</p>
                            </a>
                        </li>

                    </ul>
                </li>
                
                <!-- Trạng thái đơn hàng -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-calendar-check"></i>
                        <p>
                            Trạng thái đơn hàng
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= BASE_URL_ADMIN . '?act=status_order' ?>" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Tất cả</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= BASE_URL_ADMIN . '?act=status_order-create' ?>" class="nav-link">
                                <i class="fas fa-plus nav-icon" style="color: #ffffff;"></i>
                                <p>Thêm trạng thái</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- Sản phẩm -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>
                            Sản phẩm
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= BASE_URL_ADMIN . '?act=product' ?>" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Tất cả sản phẩm</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= BASE_URL_ADMIN . '?act=product-create' ?>" class="nav-link">
                                <i class="fas fa-plus nav-icon" style="color: #ffffff;"></i>
                                <p>Thêm sản phẩm mới</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- Đơn hàng -->
                <li class="nav-item">
                    <a href="<?= BASE_URL_ADMIN . '?act=order' ?>" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Đơn hàng
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>