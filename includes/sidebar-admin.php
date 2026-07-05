<?php
// detect current page
$current_page = basename($_SERVER['SCRIPT_NAME']);
$current_uri  = $_SERVER['REQUEST_URI'];

// helper function
function isActive($needle, $type = 'link') {
    global $current_page, $current_uri;
    if ($type === 'menu') {
        return (strpos($current_uri, $needle) !== false) ? 'menu-open' : '';
    }
    return (strpos($current_uri, $needle) !== false) ? 'active' : '';
}
?>

<!-- Custom Sidebar CSS -->
<style>
    .main-sidebar {
        background: #1e1e2d; /* dark navy */
    }
    .brand-link {
        border-bottom: 1px solid #2e2e40;
        text-align: center;
    }
    .brand-link .brand-text {
        font-weight: 600;
        font-size: 1.2rem;
        color: #ffffff;
    }
    .nav-sidebar>.nav-item>.nav-link.active {
        background: #3f51b5; /* material blue */
        color: #fff !important;
    }
    .nav-sidebar .nav-treeview>.nav-item>.nav-link.active {
        background: #5c6bc0; /* lighter blue */
        color: #fff !important;
    }
    .nav-sidebar .nav-link i {
        margin-right: .5rem;
    }
    .nav-sidebar .nav-treeview .nav-link {
        padding-left: 2.5rem;
    }
    .user-panel .info a {
        font-weight: 500;
        color: #cfd8dc;
    }
</style>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo BASE_URL ?>admin.php" class="brand-link">
        <img src="<?php echo BASE_URL ?>assets/dist/img/logo2-1.png"
             alt="Admin Logo"
             class="brand-image img-circle elevation-3"
             style="opacity:.9;width:35px;height:35px;">
        <span class="brand-text">2ccloud Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo BASE_URL ?>assets/dist/img/user2-160x160.jpg"
                     class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['user']['name']; ?></a>
            </div>
        </div>

        <!-- Sidebar Search -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar"
                       type="search"
                       placeholder="Search menu..."
                       aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?php echo BASE_URL ?>admin.php"
                       class="nav-link <?php echo isActive('admin.php'); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- CRM Leads -->
                <li class="nav-item <?php echo isActive('crmleads','menu'); ?>">
                    <a href="#" class="nav-link <?php echo isActive('crmleads'); ?>">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            CRM Leads
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>admin/crmleads/add.php"
                               class="nav-link <?php echo isActive('crmleads/add.php'); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/crmleads/"
                               class="nav-link <?php echo isActive('crmleads/index.php'); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Quotations -->
                <li class="nav-item <?php echo isActive('quotations','menu'); ?>">
                    <a href="#" class="nav-link <?php echo isActive('quotations'); ?>">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Quotations
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/quotations/"
                               class="nav-link <?php echo isActive('quotations/index.php'); ?>">
                                <i class="far fa-list-alt nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/quotations/demos.php"
                               class="nav-link <?php echo isActive('quotations/demos.php'); ?>">
                                <i class="fas fa-vials nav-icon"></i>
                                <p>Demos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/quotations/live.php"
                               class="nav-link <?php echo isActive('quotations/live.php'); ?>">
                                <i class="fas fa-vials nav-icon"></i>
                                <p>Live</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/quotations/deletion_request.php"
                               class="nav-link <?php echo isActive('quotations/deletion_request.php'); ?>">
                                <i class="fas fa-trash nav-icon"></i>
                                <p>Deletion Request</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Companies -->
                <li class="nav-item <?php echo isActive('companies','menu'); ?>">
                    <a href="#" class="nav-link <?php echo isActive('companies'); ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Companies
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/companies/add.php"
                               class="nav-link <?php echo isActive('companies/add.php'); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/companies/"
                               class="nav-link <?php echo isActive('companies/index.php'); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Products -->
                <li class="nav-item <?php echo isActive('products','menu'); ?>">
                    <a href="#" class="nav-link <?php echo isActive('products'); ?>">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Products
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/products/add.php"
                               class="nav-link <?php echo isActive('products/add.php'); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/products/"
                               class="nav-link <?php echo isActive('products/index.php') || isActive('admin/products/index.php') || (isActive('products') && !isActive('products/attributes.php') && !isActive('products/add.php')); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/products/attributes.php"
                               class="nav-link <?php echo isActive('products/attributes.php'); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product Attributes</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Users -->
                <li class="nav-item <?php echo isActive('users','menu'); ?>">
                    <a href="#" class="nav-link <?php echo isActive('users'); ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL ?>admin/users/"
                               class="nav-link <?php echo isActive('users/index.php'); ?>">
                                <i class="far fa-circle nav-icon"></i>
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
