<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="<?php echo BASE_URL ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Imegh</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo BASE_URL ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['user']['name'] ?></a>
            </div>
        </div>

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
                <li class="nav-item">
                    <a href="<?php echo BASE_URL ?>admin.php" class="nav-link">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            CRM LEADS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>admin/crmleads/add.php" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/crmleads/" class="nav-link ">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View All</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Companies
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/companies/add.php" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/companies/" class="nav-link ">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View All</p>
                            </a>
                        </li>
                        

                    </ul>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Quotations
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/quotations/" class="nav-link ">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View All</p>
                            </a>
                        </li>
                        

                    </ul>
                </li>

                
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Products
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/products/add.php" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/products/" class="nav-link ">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View All</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/products/attributes.php" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Product Attributes</p>
                            </a>
                        </li>

                    </ul>
                </li>

               <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/users/" class="nav-link ">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View All</p>
                            </a>
                        </li>
                        

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>