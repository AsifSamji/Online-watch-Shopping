<?php
include 'header2.php'; 
include("connection.php");

// Count Today's Orders
$query_today_count = "SELECT COUNT(*) AS count FROM purchases WHERE DATE(purchase_date) = CURDATE()";
$result_today_count = $con->query($query_today_count);
$today_orders = $result_today_count->fetch_assoc()['count'];

// Count Pending Orders
$query_pending_count = "SELECT COUNT(*) AS count FROM purchases WHERE order_status IN ('Processing','Shipped','Out for Delivery')";
$result_pending_count = $con->query($query_pending_count);
$pending_orders = $result_pending_count->fetch_assoc()['count'];

// Count Delivered Orders
$query_delivered_count = "SELECT COUNT(*) AS count FROM purchases WHERE order_status = 'Delivered'";
$result_delivered_count = $con->query($query_delivered_count);
$delivered_orders = $result_delivered_count->fetch_assoc()['count'];

// Count Total Products
$query_product_count = "SELECT COUNT(*) AS count FROM product"; 
$result_product_count = $con->query($query_product_count);
$product_count = $result_product_count->fetch_assoc()['count'];

// Count Total user
$query_user_count = "SELECT COUNT(*) AS count FROM registration"; 
$result_user_count = $con->query($query_user_count);
$user_count = $result_user_count->fetch_assoc()['count'];

$query_ucon_count = "SELECT COUNT(*) AS count FROM contact_messages"; 
$result_ucon_count = $con->query($query_ucon_count);
$ucon_count = $result_ucon_count->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* Global Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Dashboard Title */
        .title {
            font-size: 40px;
            font-weight: bold;
            margin-top: 30px;
            color: #333;
            padding: 10px 20px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Section Wrapper */
        .section-box {
            width: 80%;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.3);
            margin-top: 30px;
        }

        /* Section Titles */
        .section-title {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #555;
            text-transform: uppercase;
            border-bottom: 3px solid #007bff;
            display: inline-block;
            padding-bottom: 5px;
        }

        /* Container for Boxes */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
        }

        /* Styling for Each Box */
        .box {
            width: 320px;
            height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            color: white;
            border-radius: 12px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            position: relative;
        }

        .box:hover {
            transform: translateY(-5px);
            box-shadow: 6px 6px 16px rgba(0, 0, 0, 0.3);
        }

        /* Icons */
        .box i {
            font-size: 40px;
            margin-bottom: 10px;
        }

        /* Notification Badge */
.badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: red;
    color: white;
    font-size: 16px;
    font-weight: bold;
    padding: 6px 12px;
    border-radius: 20px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 35px;
    min-height: 20px;
}

/* Ensure it scales well */
@media (max-width: 768px) {
    .badge {
        font-size: 14px;
        padding: 5px 10px;
        min-width: 30px;
        min-height: 18px;
    }
}


        /* Box Colors */
        .orders { background-color: #007bff; }
        .pending { background-color: #ffcc00; color: black; }
        .delivered { background-color: #28a745; }
        .view { background-color: #17a2b8; }
        .add { background-color: #6c757d; }
        .update { background-color: #343a40; }
        .delete { background-color: #dc3545; }

        /* Responsive Design */
        @media (max-width: 768px) {
            .box {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <!-- Page Title -->
    <div class="title">Admin Dashboard</div>

   <!-- Orders Section -->
<div class="section-box">
    <div class="section-title">Orders Management Section</div>
    <div class="container">
        <a href="product/today_order.php" class="box orders">
            <i class="fas fa-shopping-cart"></i>
            Today's Orders
            <span class="badge"><?= $today_orders; ?></span>
        </a>
        <a href="product/pending_order.php" class="box pending">
            <i class="fas fa-hourglass-half"></i>
            Pending Orders
            <span class="badge"><?= $pending_orders; ?></span>
        </a>
        <a href="product/deliverd_order.php" class="box delivered">
            <i class="fas fa-check-circle"></i>
            Delivered Orders
            <span class="badge"><?= $delivered_orders; ?></span>
        </a>
    </div>
</div>


    <!-- User Management Section -->
    <div class="section-box">
        <div class="section-title">User Management Section</div>
        <div class="container">
            <a href="display.php" class="box view">
                <i class="fas fa-eye"></i>
                Total Users
                <span class="badge"><?= $user_count; ?></span>
            </a> 
            <a href="show_contact.php" class="box view">
                <i class="fas fa-eye"></i>
                View Contact Messages
                <span class="badge"><?= $ucon_count; ?></span>
            </a>
        </div>
    </div>


    <!-- Product Management Section -->
    <div class="section-box">
        <div class="section-title">Product Management Section</div>
        <div class="container">
            <a href="product/view.php" class="box view">
                <i class="fas fa-eye"></i>
                View Product
                <span class="badge"><?= $product_count; ?></span>
            </a>
            <a href="product/index.php" class="box add">
                <i class="fas fa-plus-circle"></i>
                Add Product
            </a>
            <a href="product/view_update.php" class="box update">
                <i class="fas fa-edit"></i>
                Update Product
            </a>
            <a href="product/view_delete.php" class="box delete">
                <i class="fas fa-trash"></i>
                Delete Product
            </a>
        </div>
    </div>

</body>
</html>
