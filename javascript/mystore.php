<?php
include 'header2.php'; 
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      background-color: #f4f6f9; /* Light gray background for better contrast */
    }
    .content-wrapper {
      padding: 20px;
    }
    h2 {
      color: #333;
      font-size: 36px;
    }
    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link {
      color: #fff;
    }
   aside{
    margin-top: 80px; /* Adjust the value for more or less space */
   }

  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">   
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">Admin Dashboard</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">Admin</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/pending_order.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>pending orders</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/display.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users Data</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/product/index.php" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Add Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/product/view.php" class="nav-link">
                            <i class="nav-icon fas fa-eye"></i>
                            <p>View Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/product/view_update.php" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Update Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/product/view_delete.php" class="nav-link">
                            <i class="nav-icon fas fa-trash"></i>
                            <p>Delete Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/product/view_purchase.php" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Purchase Product</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <h2>Welcome to the Admin Dashboard</h2>
            <p>Manage users, products, and orders easily with the navigation options on the left.</p>
        </div>

        <div class="row">
            <!-- Users Data -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="http://localhost/mobile_shopping/admin/display.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="col-md-3">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>500</h3>
                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cart-plus"></i>
                    </div>
                    <a href="http://localhost/mobile_shopping/admin/product/view_purchase.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Add Product -->
            <div class="col-md-3">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Add</h3>
                        <p>Product</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <a href="http://localhost/mobile_shopping/admin/product/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Update Product -->
            <div class="col-md-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Update</h3>
                        <p>Product</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <a href="http://localhost/mobile_shopping/admin/product/view_update.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Delete Product -->
            <div class="col-md-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Delete</h3>
                        <p>Product</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <a href="http://localhost/mobile_shopping/admin/product/view_delete.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- View Product -->
            <div class="col-md-3">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>View</h3>
                        <p>Products</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <a href="http://localhost/mobile_shopping/admin/product/view.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>&copy; 2025 Your Company. All Rights Reserved.</strong>
    </footer>
</div>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>

</body>
</html>
