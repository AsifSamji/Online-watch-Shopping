<?php
session_start();
include("connection.php");

if (!isset($_SESSION['us_id'])) {
    echo "<script>window.location.href = '../html/login.html';</script>";
    exit();
}

$user_id = $_SESSION['us_id'];

// Handle the purchase form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['purchase'])) {
    $cart_id = $_POST['cart_id'];
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $total_price = (float)$_POST['total_price'];
    $new_address = $_POST['new_address'];
    $payment_method = $_POST['payment_method'];

    // Check stock availability
    $stock_query = "SELECT P_QUENTITY FROM product WHERE ID = '$product_id'";
    $stock_result = $con->query($stock_query);
    
    if ($stock_result->num_rows == 0) {
        echo "<script>alert('Error: Product not found.'); window.history.back();</script>";
        exit();
    }

    $stock_row = $stock_result->fetch_assoc();
    $current_stock = isset($stock_row['P_QUENTITY']) ? (int)$stock_row['P_QUENTITY'] : 0;

    if ($quantity > $current_stock) {
        echo "<script>alert('Not enough stock available.'); window.history.back();</script>";
        exit();
    }

    // Update stock
    $new_stock = $current_stock - $quantity;
    $update_stock_query = "UPDATE product SET P_QUENTITY = $new_stock WHERE ID = '$product_id'";
    $con->query($update_stock_query);

    // Insert the purchase
    $purchase_query = "INSERT INTO purchases (user_id, product_id, quantity, price, address, payment_method, order_status) 
                       VALUES ('$user_id', '$product_id', '$quantity', '$total_price', '$new_address', '$payment_method', 'Processing')";
    $con->query($purchase_query);

    // Remove from cart
    $delete_cart_query = "DELETE FROM cart WHERE id = '$cart_id'";
    $con->query($delete_cart_query);

    echo "<script>alert('Purchase successful!'); window.location.href = 'viewpurchase.php';</script>";
    exit();
}
?>
