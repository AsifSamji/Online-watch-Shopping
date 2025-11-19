<?php
session_start();
if (!isset($_SESSION['ad'])) {
    header("Location: http://localhost/mobile_shopping/admin/adminlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">

    <style>
        /* Navbar Styling */
        .navbar {
            position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #343a40 !important;
    height: 80px;
    padding: 10px 20px;
    z-index: 1000; /* Ensures it's on top */
        }
        .navbar-brand {
            font-size: 2.5rem;
            font-weight: bold;
            color: #ffc107 !important;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
        }
        .navbar-brand i {
            margin-right: 10px;
        }
        .nav-link {
            color: white !important;
            font-size: 1rem;
            font-weight: 500;
            padding: 10px 15px;
            transition: 0.3s ease-in-out;
        }
        .nav-link:hover {
            color: #ffc107 !important;
            transform: scale(1.1);
        }
        .user-text {
            font-size: 1rem;
            color: white;
            font-weight: 500;
            margin-right: 15px;
        }
        .nav-item i {
            margin-right: 8px;
        }

        /* Sidebar Styling */
        .wrapper {
            display: flex;
            width: 100%;
            margin-top: 80px; /* Push content below the navbar */
        }
        .main-sidebar {
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            top: 0;
            left: 0;
        }
        .content-wrapper {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }
        aside
        {
            margin-top : 80px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container-fluid">
        <a href="http://localhost/mobile_shopping/admin/mystore.php" class="navbar-brand">
            <i class="fas fa-store"></i> My Store
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <span class="user-text"><i class="fas fa-user"></i> Hello, <?php echo $_SESSION['ad']; ?>!</span>
                </li>
                <li class="nav-item">
                    <a href="http://localhost/mobile_shopping/admin/product/reports.php" class="nav-link">
                    <i class="fas fa-chart-bar"></i> Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a href="http://localhost/mobile_shopping/api/homepage.php" class="nav-link">
                        <i class="fas fa-home"></i> User Panel
                    </a>
                </li>
                <li class="nav-item">
                    <a href="http://localhost/mobile_shopping/admin/adminlogout.php" class="nav-link text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="wrapper">
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    
                    <!-- Order Management -->
                    <li class="nav-header">ORDER MANAGEMENT</li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/product/today_order.php" class="nav-link">
                            <i class="nav-icon fas fa-calendar-day"></i>
                            <p>Today's Orders</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/product/pending_order.php" class="nav-link">
                            <i class="nav-icon fas fa-hourglass-half"></i>
                            <p>Pending Orders</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/product/deliverd_order.php" class="nav-link">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>Delivered Orders</p>
                        </a>
                    </li>


 <!-- user Management -->
 <li class="nav-header">USER MANAGEMENT</li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/display.php" class="nav-link">
                            <i class="nav-icon  fas fa-eye"></i>
                            <p>Users Data</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/show_contact.php" class="nav-link">
                            <i class="nav-icon  fas fa-eye"></i>
                            <p>Contact Messages</p>
                        </a>
                    </li>
                  


                    <!-- Product Management -->
                    <li class="nav-header">PRODUCT MANAGEMENT</li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/product/view.php" class="nav-link">
                            <i class="nav-icon fas fa-eye"></i>
                            <p>View Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/product/index.php" class="nav-link">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>Add Product</p>
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
                            <i class="nav-icon fas fa-trash-alt"></i>
                            <p>Delete Product</p>
                        </a>
                    </li>

 <!-- Report Management -->
 <li class="nav-header">REPORTS</li>
                    <li class="nav-item">
                        <a href="http://localhost/mobile_shopping/admin/product/reports.php" class="nav-link">
                            <i class="nav-icon  fas fa-chart-bar"></i>
                            <p>Reports</p>
                        </a>
                    </li>

                   
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
    </body>
    <html>